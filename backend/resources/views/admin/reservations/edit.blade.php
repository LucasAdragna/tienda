@extends('layouts.admin')

@section('title', 'Editar reserva')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Editar reserva</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card-style mb-30">
        <div class="card-body">
            <form action="{{ route('admin.reservas.update', $reservation) }}" method="POST">
                @method('PUT')
                @include('admin.reservations.form')
            </form>
        </div>
    </div>
@endsection
