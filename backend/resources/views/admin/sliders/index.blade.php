@extends('layouts.admin')

@section('title', 'Slider')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Slider principal</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-wrapper mb-30 text-md-end">
                    <a href="{{ route('admin.sliders.create') }}" class="main-btn primary-btn btn-hover">Nuevo slide</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-style mb-30">
        <div class="table-wrapper table-responsive data-grid-wrap">
            <table class="table grid-table">
                <thead>
                <tr>
                    <th>Orden</th>
                    <th>Imagen</th>
                    <th>Titulo</th>
                    <th>Link</th>
                    <th>Visible</th>
                    <th class="text-end">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($sliders as $slider)
                    @php
                        $imageUrl = str_starts_with($slider->s_imagen, 'http')
                            ? $slider->s_imagen
                            : asset('storage/' . $slider->s_imagen);
                    @endphp
                    <tr>
                        <td>{{ $slider->s_orden }}</td>
                        <td>
                            <img src="{{ $imageUrl }}" alt="{{ $slider->s_titulo }}" style="width: 100px; height: 56px; object-fit: cover; border-radius: 8px;">
                        </td>
                        <td>
                            <h6>{{ $slider->s_titulo }}</h6>
                        </td>
                        <td>{{ $slider->s_link }}</td>
                        <td>
                            @if((int) $slider->s_visible === 1)
                                <span class="bool-indicator is-true" title="Visible">&#10003;</span>
                            @else
                                <span class="bool-indicator is-false" title="No visible">&#10005;</span>
                            @endif
                        </td>

                        <td class="text-end">
                            <a href="{{ route('admin.sliders.edit', $slider) }}" class="icon-action-btn is-edit" title="Editar">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="d-inline">
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
                        <td colspan="6" class="text-center text-muted py-4">No hay slides cargados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($sliders->hasPages())
            <div class="mt-3">
                {{ $sliders->links() }}
            </div>
        @endif
    </div>
@endsection
