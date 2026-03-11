<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(): View
    {
        $reservations = Reservation::latest('reservation_date')->paginate(10);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function create(): View
    {
        return view('admin.reservations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'customer_email' => ['required', 'email', 'max:120'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'reservation_date' => ['required', 'date'],
            'people_count' => ['required', 'integer', 'min:1', 'max:20'],
            'status' => ['required', 'in:pendiente,confirmada,cancelada,completada'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        Reservation::create($data);

        return redirect()->route('admin.reservas.index')->with('success', 'Reserva creada correctamente.');
    }

    public function edit(Reservation $reserva): View
    {
        return view('admin.reservations.edit', ['reservation' => $reserva]);
    }

    public function update(Request $request, Reservation $reserva): RedirectResponse
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'customer_email' => ['required', 'email', 'max:120'],
            'customer_phone' => ['required', 'string', 'max:30'],
            'reservation_date' => ['required', 'date'],
            'people_count' => ['required', 'integer', 'min:1', 'max:20'],
            'status' => ['required', 'in:pendiente,confirmada,cancelada,completada'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $reserva->update($data);

        return redirect()->route('admin.reservas.index')->with('success', 'Reserva actualizada correctamente.');
    }

    public function destroy(Reservation $reserva): RedirectResponse
    {
        $reserva->delete();

        return redirect()->route('admin.reservas.index')->with('success', 'Reserva eliminada correctamente.');
    }
}
