@extends('layouts.admin')

@section('title', 'Reservas')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Reservas</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30 text-md-end">
                    <a href="{{ route('admin.reservas.create') }}" class="main-btn primary-btn btn-hover">Nueva reserva</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-style mb-30">
        <div class="table-wrapper table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Personas</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>
                            <h6>{{ $reservation->customer_name }}</h6>
                            <p class="text-sm mb-0">{{ $reservation->customer_email }}</p>
                        </td>
                        <td>{{ $reservation->reservation_date->format('d/m/Y H:i') }}</td>
                        <td>{{ $reservation->people_count }}</td>
                        <td><span class="status-btn info-btn">{{ ucfirst($reservation->status) }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('admin.reservas.edit', $reservation) }}" class="main-btn warning-btn-outline btn-hover btn-sm">Editar</a>
                            <form action="{{ route('admin.reservas.destroy', $reservation) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="main-btn danger-btn-outline btn-hover btn-sm" data-confirm-delete>Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No hay reservas cargadas.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($reservations->hasPages())
            <div class="mt-3">
                {{ $reservations->links() }}
            </div>
        @endif
    </div>
@endsection
