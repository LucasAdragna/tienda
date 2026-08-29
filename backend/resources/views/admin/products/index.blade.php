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
        <div class="table-wrapper table-responsive data-grid-wrap">
            <table class="table grid-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Habitacion</th>
                    <th>Tipo</th>
                    <th>Tarifa</th>
                    <th>Disponibles</th>
                    <th>Visible</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td class="text-center">{{ $product->id }}</td>
                        <td>
                            <h6>{{ $product->name }}</h6>
                        </td>
                        <td>{{ $product->category?->name ?? 'Sin tipo' }}</td>
                        <td>${{ number_format((float) $product->price, 2, ',', '.') }}</td>
                        <td class="text-center">{{ $product->stock }}</td>
                        <td class="text-center">
                            <form action="{{ route('admin.productos.visibility', $product) }}" method="POST" class="d-inline" data-toggle-visibility>
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bool-indicator {{ $product->is_visible ? 'is-true' : 'is-false' }} border-0" title="{{ $product->is_visible ? 'Visible' : 'No visible' }}" aria-label="{{ $product->is_visible ? 'Visible' : 'No visible' }}">
                                    {!! $product->is_visible ? '&#10003;' : '&#10005;' !!}
                                </button>
                            </form>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.productos.edit', $product) }}" class="icon-action-btn is-edit" title="Editar">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.productos.destroy', $product) }}" method="POST" class="d-inline">
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
