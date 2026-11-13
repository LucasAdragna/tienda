@extends('layouts.admin')
@section('title', 'Promociones')
@section('content')
    <div class="title-wrapper pt-30 d-flex flex-wrap justify-content-between align-items-center gap-3 mb-30">
        <h2>Promociones</h2>
        <a href="{{ route('admin.promociones.create') }}" class="main-btn primary-btn btn-hover">Nueva promoción</a>
    </div>
    <div class="card-style mb-30">
        <p class="text-muted mb-3">El inicio muestra la última promoción creada que esté habilitada y vigente. El vencimiento es automático, según la zona {{ config('app.timezone') }}.</p>
        <div class="table-responsive">
            <table class="table">
                <thead><tr><th>Título</th><th>Publicación</th><th>Estado</th><th>Acciones</th></tr></thead>
                <tbody>
                @forelse($promotions as $promotion)
                    @php
                        $status = ! $promotion->is_active ? 'Oculta' : ($promotion->ends_on->lt(today()) ? 'Vencida' : ($promotion->starts_on->gt(today()) ? 'Programada' : 'Vigente'));
                    @endphp
                    <tr>
                        <td>{{ $promotion->title }}</td>
                        <td>{{ $promotion->starts_on->format('d/m/Y') }} — {{ $promotion->ends_on->format('d/m/Y') }}</td>
                        <td>{{ $status }}</td>
                        <td>
                            <a href="{{ route('admin.promociones.edit', $promotion) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="{{ route('admin.promociones.destroy', $promotion) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" data-confirm-delete>Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-4">No hay promociones. Creá una para mostrar el banner en el inicio.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $promotions->links() }}
    </div>
@endsection
