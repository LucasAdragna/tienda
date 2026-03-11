@extends('layouts.admin')

@section('title', 'Categorias')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Tipos de habitacion</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30 text-md-end">
                    <a href="{{ route('admin.categorias.create') }}" class="main-btn primary-btn btn-hover">Nuevo tipo</a>
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
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            <h6>{{ $category->name }}</h6>
                            <p class="text-sm mb-0">{{ $category->description }}</p>
                        </td>
                        <td>
                            @if($category->is_active)
                                <span class="status-btn success-btn">Activa</span>
                            @else
                                <span class="status-btn close-btn">Inactiva</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.categorias.edit', $category) }}" class="main-btn warning-btn-outline btn-hover btn-sm">Editar</a>
                            <form action="{{ route('admin.categorias.destroy', $category) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="main-btn danger-btn-outline btn-hover btn-sm" data-confirm-delete>Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">No hay tipos cargados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($categories->hasPages())
            <div class="mt-3">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
