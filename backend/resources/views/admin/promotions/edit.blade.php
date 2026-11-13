@extends('layouts.admin')
@section('title', 'Editar promoción')
@section('content')
    <div class="title-wrapper pt-30"><h2 class="mb-30">Editar promoción</h2></div>
    <div class="card-style mb-30">
        <form action="{{ route('admin.promociones.update', $promotion) }}" method="POST">
            @include('admin.promotions.form')
        </form>
    </div>
@endsection
