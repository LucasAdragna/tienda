<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PublicReservationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'checkIn' => ['required', 'date_format:Y-m-d', 'after_or_equal:today'],
            'checkOut' => ['required', 'date_format:Y-m-d', 'after:checkIn'],
            'adults' => ['required', 'integer', 'min:1', 'max:8'],
            'children' => ['required', 'integer', 'min:0', 'max:6'],
            'roomType' => ['required', 'string', 'max:120'],
            'guestName' => ['required', 'string', 'min:3', 'max:120'],
            'guestEmail' => ['required', 'email:rfc', 'max:120'],
            'guestPhone' => ['required', 'string', 'regex:/^[+\d()\-\s]{7,30}$/'],
            'website' => ['nullable', Rule::prohibitedIf(fn () => filled($request->input('website')))],
        ], [
            'checkIn.after_or_equal' => 'La fecha de entrada no puede ser anterior a hoy.',
            'checkOut.after' => 'La fecha de salida debe ser posterior al check-in.',
            'guestPhone.regex' => 'Ingresa un telefono valido.',
            'website.prohibited' => 'Solicitud rechazada.',
        ]);

        $validator->after(function ($validator) use ($request): void {
            $peopleCount = (int) $request->input('adults', 0) + (int) $request->input('children', 0);

            if ($peopleCount > 8) {
                $validator->errors()->add('children', 'La ocupacion maxima por reserva es de 8 personas.');
            }

            $room = Product::query()
                ->where('slug', $request->input('roomType'))
                ->where('is_active', true)
                ->where('is_visible', true)
                ->first();

            if (! $room) {
                $validator->errors()->add('roomType', 'Selecciona una habitacion disponible.');

                return;
            }

            if ($peopleCount > max(1, (int) $room->stock)) {
                $validator->errors()->add('children', 'La habitacion seleccionada no admite esa cantidad de personas.');

                return;
            }

            if (! $request->filled(['checkIn', 'checkOut'])) {
                return;
            }

            $hasConfirmedOverlap = Reservation::query()
                ->where('room_type', $room->slug)
                ->where('status', 'confirmada')
                ->whereDate('check_in', '<', $request->input('checkOut'))
                ->whereDate('check_out', '>', $request->input('checkIn'))
                ->exists();

            if ($hasConfirmedOverlap) {
                $validator->errors()->add('roomType', 'La habitacion no esta disponible para esas fechas.');
            }
        });

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Revisa los campos marcados antes de continuar.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();
        $peopleCount = (int) $data['adults'] + (int) $data['children'];

        $reservation = Reservation::create([
            'customer_name' => trim((string) $data['guestName']),
            'customer_email' => strtolower(trim((string) $data['guestEmail'])),
            'customer_phone' => trim((string) $data['guestPhone']),
            'reservation_date' => $data['checkIn'].' 15:00:00',
            'check_in' => $data['checkIn'],
            'check_out' => $data['checkOut'],
            'room_type' => trim((string) $data['roomType']),
            'adults' => (int) $data['adults'],
            'children' => (int) $data['children'],
            'people_count' => $peopleCount,
            'status' => 'pendiente',
            'notes' => 'Reserva solicitada desde el sitio web.',
        ]);

        return response()->json([
            'message' => 'Recibimos tu solicitud de reserva. El hotel se comunicara para confirmarla.',
            'data' => [
                'id' => $reservation->id,
                'status' => $reservation->status,
            ],
        ], 201);
    }
}
