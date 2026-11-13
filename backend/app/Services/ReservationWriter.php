<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReservationWriter
{
    /** Every product is one physical room; stock remains its guest capacity. */
    public function save(array $data, ?Reservation $reservation = null, bool $public = false): Reservation
    {
        return DB::transaction(function () use ($data, $reservation, $public): Reservation {
            $roomField = $public ? 'roomType' : 'product_id';
            $query = Product::query();
            $public ? $query->where('slug', $data['room_type']) : $query->whereKey($data['product_id'] ?? null);

            // Serialize all bookings for this physical unit, including when no bookings exist yet.
            $room = $query->lockForUpdate()->first();
            $current = $reservation ? Reservation::query()->whereKey($reservation->id)->lockForUpdate()->firstOrFail() : null;

            if (! $room) {
                // Old unmatched records remain visible and can always be cancelled.
                if ($current && ! $current->product_id && empty($data['product_id']) && $data['status'] === 'cancelada') {
                    unset($data['product_id'], $data['room_type']);
                    $current->update($this->withOccupancy($data));

                    return $current;
                }
                throw ValidationException::withMessages([$roomField => 'Seleccioná una habitación física existente.']);
            }

            $releasing = $current && $data['status'] === 'cancelada' && (int) $current->product_id === $room->id;
            if (! $releasing && (! $room->is_active || ($public && ! $room->is_visible))) {
                throw ValidationException::withMessages([$roomField => 'La habitación no está disponible para nuevas reservas.']);
            }

            $data = $this->withOccupancy($data);
            if (! $releasing && ($data['people_count'] > 8 || $data['people_count'] > max(1, (int) $room->stock))) {
                throw ValidationException::withMessages(['children' => 'La habitación seleccionada no admite esa cantidad de personas.']);
            }

            if ($public || in_array($data['status'], ['confirmada', 'completada'], true)) {
                $unresolved = Reservation::query()->whereNull('product_id')
                    ->whereIn('status', ['confirmada', 'completada'])
                    ->where(fn ($query) => $query->whereNull('room_type')->orWhereNotIn('room_type', Product::select('slug')))
                    ->when($current, fn ($query) => $query->where('id', '!=', $current->id))
                    ->where(fn ($query) => $query->whereNull('check_in')->orWhereNull('check_out')
                        ->orWhere(fn ($dated) => $dated->whereDate('check_in', '<', $data['check_out'])->whereDate('check_out', '>', $data['check_in'])))
                    ->lockForUpdate()->get(['id']);

                if ($unresolved->isNotEmpty()) {
                    throw ValidationException::withMessages([$roomField => 'El hotel debe revisar reservas anteriores sin habitación vinculada antes de confirmar disponibilidad para esas fechas.']);
                }

                $overlaps = Reservation::query()
                    ->where(function ($query) use ($room): void {
                        $query->where('product_id', $room->id)
                            ->orWhere(fn ($legacy) => $legacy->whereNull('product_id')->where('room_type', $room->slug));
                    })
                    ->whereIn('status', ['confirmada', 'completada'])
                    ->when($current, fn ($query) => $query->where('id', '!=', $current->id))
                    ->where(fn ($query) => $query->whereNull('check_in')->orWhereNull('check_out')
                        ->orWhere(fn ($dated) => $dated->whereDate('check_in', '<', $data['check_out'])->whereDate('check_out', '>', $data['check_in'])))
                    // A locking read sees the latest commit under MySQL REPEATABLE READ.
                    ->lockForUpdate()->get(['id']);

                if ($overlaps->isNotEmpty()) {
                    throw ValidationException::withMessages([$roomField => 'La habitación ya está reservada para esas fechas.']);
                }
            }

            $data['product_id'] = $room->id;
            $data['room_type'] = $room->slug;
            if ($current) {
                $current->update($data);

                return $current;
            }

            return Reservation::create($data);
        }, 3);
    }

    private function withOccupancy(array $data): array
    {
        $data['people_count'] = (int) $data['adults'] + (int) $data['children'];
        $data['reservation_date'] = $data['check_in'].' 15:00:00';

        return $data;
    }
}
