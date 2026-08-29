@extends('layouts.admin')

@section('title', 'Editar sobre nosotros')

@section('content')
    <div class="title-wrapper pt-30"><div class="title mb-30"><h2>Editar sobre nosotros</h2></div></div>
    <div class="card-style mb-30"><div class="card-body"><form action="{{ route('admin.sobre-nosotros.update', $aboutUs) }}" method="POST" enctype="multipart/form-data">@method('PUT') @include('admin.about-us.form')</form></div></div>
@endsection
