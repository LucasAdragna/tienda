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
        <div class="table-wrapper table-responsive data-grid-wrap">
            <table class="table grid-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Estadia</th>
                    <th>Habitacion</th>
                    <th>Personas</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($reservations as $reservation)
                    <tr>
                        <td class="text-center">{{ $reservation->id }}</td>
                        <td>
                            <h6>{{ $reservation->customer_name }}</h6>
                        </td>
                        <td>
                            @if($reservation->check_in && $reservation->check_out)
                                {{ $reservation->check_in->format('d/m/Y') }} al {{ $reservation->check_out->format('d/m/Y') }}
                            @else
                                {{ $reservation->reservation_date->format('d/m/Y H:i') }}
                            @endif
                        </td>
                        <td>{{ $reservation->room_type ?? '-' }}</td>
                        <td class="text-center">{{ $reservation->people_count }}</td>
                        <td><span class="status-btn info-btn">{{ ucfirst($reservation->status) }}</span></td>
                        <td class="text-center">
                            <a href="{{ route('admin.reservas.edit', $reservation) }}" class="icon-action-btn is-edit" title="Editar">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.reservas.destroy', $reservation) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="icon-action-btn is-delete" data-confirm-delete title="Eliminar">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No hay reservas cargadas.</td>
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
