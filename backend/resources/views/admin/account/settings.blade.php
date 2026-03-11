@extends('layouts.admin')

@section('title', 'Configuracion')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Configuracion del panel</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card-style mb-30">
        <h6 class="mb-20">Preferencias</h6>
        <p class="text-sm mb-10">El modo claro/oscuro ya se puede cambiar desde el header y queda guardado en el navegador.</p>
        <p class="text-sm mb-0">Podemos agregar aca configuraciones del hotel (moneda, zona horaria, politicas de reserva, etc.).</p>
    </div>
@endsection
