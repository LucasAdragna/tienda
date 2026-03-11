@extends('layouts.admin')

@section('title', 'Productos')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Habitaciones</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30 text-md-end">
                    <a href="{{ route('admin.productos.create') }}" class="main-btn primary-btn btn-hover">Nueva habitacion</a>
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
                    <th>Habitacion</th>
                    <th>Tipo</th>
                    <th>Tarifa</th>
                    <th>Disponibles</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            <h6>{{ $product->name }}</h6>
                            <p class="text-sm mb-0">{{ $product->slug }}</p>
                        </td>
                        <td>{{ $product->category?->name ?? 'Sin tipo' }}</td>
                        <td>${{ number_format((float) $product->price, 2, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            @if($product->is_active)
                                <span class="status-btn success-btn">Activa</span>
                            @else
                                <span class="status-btn close-btn">Inactiva</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.productos.edit', $product) }}" class="main-btn warning-btn-outline btn-hover btn-sm">Editar</a>
                            <form action="{{ route('admin.productos.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="main-btn danger-btn-outline btn-hover btn-sm" data-confirm-delete>Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No hay habitaciones cargadas.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
            <div class="mt-3">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
