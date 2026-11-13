<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Reservation;
use App\Services\ReservationWriter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(): View
    {
        $reservations = Reservation::with('room')->latest('check_in')->latest('reservation_date')->paginate(10);
        $unlinkedReservations = Reservation::whereNull('product_id')->whereIn('status', ['pendiente', 'confirmada', 'completada'])->count();
        return view('admin.reservations.index', compact('reservations', 'unlinkedReservations'));
    }

    public function create(): View
    {
        return view('admin.reservations.create', ['rooms' => Product::where('is_active', true)->orderBy('name')->orderBy('id')->get()]);
    }

    public function store(Request $request, ReservationWriter $writer): RedirectResponse
    {
        $writer->save($this->validated($request, true));
        return redirect()->route('admin.reservas.index')->with('success', 'Reserva creada correctamente.');
    }

    public function edit(Reservation $reserva): View
    {
        return view('admin.reservations.edit', [
            'reservation' => $reserva,
            'rooms' => Product::query()->where('is_active', true)->orWhere('id', $reserva->product_id)->orderBy('name')->orderBy('id')->get(),
        ]);
    }

    public function update(Request $request, Reservation $reserva, ReservationWriter $writer): RedirectResponse
    {
        $writer->save($this->validated($request, false), $reserva);
        return redirect()->route('admin.reservas.index')->with('success', 'Reserva actualizada correctamente.');
    }

    private function validated(Request $request, bool $creating): array
    {
        return $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'customer_email' => ['required', 'email', 'max:120'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'check_in' => $creating ? ['required', 'date_format:Y-m-d', 'after_or_equal:today'] : ['required', 'date_format:Y-m-d'],
            'check_out' => ['required', 'date_format:Y-m-d', 'after:check_in'],
            'product_id' => ['nullable', 'integer'],
            'adults' => ['required', 'integer', 'min:1', 'max:8'],
            'children' => ['required', 'integer', 'min:0', 'max:6'],
            'status' => ['required', 'in:pendiente,confirmada,cancelada,completada'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);
    }

    public function destroy(Reservation $reserva): RedirectResponse
    {
        $reserva->delete();
        return redirect()->route('admin.reservas.index')->with('success', 'Reserva eliminada correctamente.');
    }
}
