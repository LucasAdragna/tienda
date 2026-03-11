@extends('layouts.admin')

@section('title', 'Editar producto')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Editar habitacion</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card-style mb-30">
        <div class="card-body">
            <form action="{{ route('admin.productos.update', $product) }}" method="POST">
                @method('PUT')
                @include('admin.products.form')
            </form>
        </div>
    </div>
@endsection
