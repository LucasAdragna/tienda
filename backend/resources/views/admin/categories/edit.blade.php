@extends('layouts.admin')

@section('title', 'Editar categoria')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Editar tipo de habitacion</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card-style mb-30">
        <div class="card-body">
            <form action="{{ route('admin.categorias.update', $category) }}" method="POST">
                @method('PUT')
                @include('admin.categories.form')
            </form>
        </div>
    </div>
@endsection
