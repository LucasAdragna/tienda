@extends('layouts.admin')

@section('title', 'Nueva categoria')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Nuevo tipo de habitacion</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card-style mb-30">
        <div class="card-body">
            <form action="{{ route('admin.categorias.store') }}" method="POST">
                @include('admin.categories.form')
            </form>
        </div>
    </div>
@endsection
