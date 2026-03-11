@extends('layouts.admin')

@section('title', 'Nueva reserva')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Nueva reserva</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card-style mb-30">
        <div class="card-body">
            <form action="{{ route('admin.reservas.store') }}" method="POST">
                @include('admin.reservations.form')
            </form>
        </div>
    </div>
@endsection
