@extends('layouts.admin')

@section('title', 'Nuevo contenido institucional')

@section('content')
    <div class="title-wrapper pt-30"><div class="title mb-30"><h2>Nuevo contenido institucional</h2></div></div>
    <div class="card-style mb-30"><div class="card-body"><form action="{{ route('admin.sobre-nosotros.store') }}" method="POST" enctype="multipart/form-data">@include('admin.about-us.form')</form></div></div>
@endsection
