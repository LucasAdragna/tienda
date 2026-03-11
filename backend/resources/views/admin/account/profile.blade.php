@extends('layouts.admin')

@section('title', 'Perfil')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Perfil del administrador</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card-style mb-30">
        <div class="row">
            <div class="col-md-8">
                <h6 class="mb-20">Informacion de cuenta</h6>
                <div class="input-style-1">
                    <label>Nombre</label>
                    <input type="text" value="{{ $user?->name ?? 'Administrador' }}" disabled>
                </div>
                <div class="input-style-1">
                    <label>Email</label>
                    <input type="text" value="{{ $user?->email ?? 'admin@hotel.local' }}" disabled>
                </div>
                <p class="text-sm mb-0">En la siguiente iteracion podemos habilitar edicion de perfil y cambio de password.</p>
            </div>
        </div>
    </div>
@endsection
