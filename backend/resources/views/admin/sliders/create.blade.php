@extends('layouts.admin')

@section('title', 'Nuevo slide')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Nuevo slide</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card-style mb-30">
        <div class="card-body">
            <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                @include('admin.sliders.form')
            </form>
        </div>
    </div>
@endsection
