@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Dashboard Hotel</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card-style mb-30">
                <h6 class="mb-10">Tipos de habitacion</h6>
                <h3>{{ $totalCategories }}</h3>
                <p class="text-sm text-medium">Categorias de habitaciones cargadas</p>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card-style mb-30">
                <h6 class="mb-10">Habitaciones</h6>
                <h3>{{ $totalProducts }}</h3>
                <p class="text-sm text-medium">Habitaciones y unidades disponibles</p>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card-style mb-30">
                <h6 class="mb-10">Reservas</h6>
                <h3>{{ $totalReservations }}</h3>
                <p class="text-sm text-medium">Reservas registradas</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-6">
            <div class="card-style mb-30">
                <h6 class="mb-20">Ultimas reservas</h6>
                <div class="table-wrapper table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($latestReservations as $reservation)
                            <tr>
                                <td>{{ $reservation->customer_name }}</td>
                                <td>{{ $reservation->reservation_date->format('d/m/Y H:i') }}</td>
                                <td><span class="status-btn info-btn">{{ ucfirst($reservation->status) }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-3">Sin reservas.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card-style mb-30">
                <h6 class="mb-20">Habitaciones con baja disponibilidad</h6>
                <div class="table-wrapper table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Habitacion</th>
                            <th>Stock</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($lowStockProducts as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td><span class="status-btn warning-btn">{{ $product->stock }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted py-3">Sin datos para mostrar.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
