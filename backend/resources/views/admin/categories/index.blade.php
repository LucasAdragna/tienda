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
        <div class="table-wrapper table-responsive data-grid-wrap">
            <table class="table grid-table">
                <thead>
                <tr>
                    <th class="text-center">Orden</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Visible</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td class="text-center">{{ $category->sort_order }}</td>
                        <td class="text-center">
                            <h6>{{ $category->name }}</h6>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.categorias.visibility', $category) }}" method="POST" class="d-inline" data-toggle-visibility>
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bool-indicator {{ $category->is_visible ? 'is-true' : 'is-false' }} border-0" title="{{ $category->is_visible ? 'Visible' : 'No visible' }}" aria-label="{{ $category->is_visible ? 'Visible' : 'No visible' }}">
                                    {!! $category->is_visible ? '&#10003;' : '&#10005;' !!}
                                </button>
                            </form>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.categorias.edit', $category) }}" class="icon-action-btn is-edit" title="Editar">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.categorias.destroy', $category) }}" method="POST" class="d-inline">
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
                        <td colspan="5" class="text-center text-muted py-4">No hay tipos cargados.</td>
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
