@extends('layouts.admin')

@section('title', 'Sobre nosotros')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6"><div class="title mb-30"><h2>Sobre nosotros</h2></div></div>
            <div class="col-md-6"><div class="breadcrumb-wrapper mb-30 text-md-end"><a href="{{ route('admin.sobre-nosotros.create') }}" class="main-btn primary-btn btn-hover">Nuevo contenido</a></div></div>
        </div>
    </div>

    <div class="card-style mb-30">
        <div class="table-wrapper table-responsive">
            <table class="table grid-table">
                <thead><tr><th>Imagen</th><th>Título</th><th>Texto</th><th>Activo</th><th class="text-end">Acciones</th></tr></thead>
                <tbody>
                    @forelse($aboutEntries as $aboutUs)
                        <tr>
                            <td><img src="{{ asset('storage/'.$aboutUs->so_imagen) }}" alt="{{ $aboutUs->so_titulo }}" style="width: 100px; height: 60px; object-fit: cover; border-radius: 8px;"></td>
                            <td><h6>{{ $aboutUs->so_titulo }}</h6></td>
                            <td>{{ $aboutUs->so_texto }}</td>
                            <td class="text-center"><span class="bool-indicator {{ $aboutUs->so_activo ? 'is-true' : 'is-false' }}" title="{{ $aboutUs->so_activo ? 'Activo' : 'Inactivo' }}">{{ $aboutUs->so_activo ? '✓' : '✕' }}</span></td>
                            <td class="text-end">
                                <a href="{{ route('admin.sobre-nosotros.edit', $aboutUs) }}" class="icon-action-btn is-edit" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('admin.sobre-nosotros.destroy', $aboutUs) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button type="submit" class="icon-action-btn is-delete" data-confirm-delete title="Eliminar"><i class="fa-regular fa-trash-can"></i></button></form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Todavía no cargaste contenido institucional.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($aboutEntries->hasPages())<div class="mt-3">{{ $aboutEntries->links() }}</div>@endif
    </div>
@endsection
