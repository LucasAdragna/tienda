@extends('layouts.admin')
@section('title', 'Nueva promoción')
@section('content')
    <div class="title-wrapper pt-30"><h2 class="mb-30">Nueva promoción</h2></div>
    <div class="card-style mb-30">
        <form action="{{ route('admin.promociones.store') }}" method="POST">
            @include('admin.promotions.form')
        </form>
    </div>
@endsection
