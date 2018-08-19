@extends('layouts.main')
    @push('sidebar')
        @include('events.sidebar')
    @endpush
    @section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row pt-5">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-body text-center">
                    <h1>0</h1>
                    <p class="text-secondary">ORDENES PAGADAS</p>
                </div>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="card">
                <div class="card-body text-center">
                    <h1>0</h1>
                    <p class="text-secondary">ORDENES PENDIENTES</p>
                </div>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="card">
                <div class="card-body text-center">
                    <h1>0</h1>
                    <p class="text-secondary">ORDENES CANCELADAS</p>
                </div>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="card">
                <div class="card-body text-center">
                    <h1>0</h1>
                    <p class="text-secondary">VISTAS DEL EVENTO</p>
                </div>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="card">
                <div class="card-body text-center">
                    <h1>0</h1>
                    <p class="text-secondary">IMPRESIONES ESTIMADAS</p>
                </div>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="card">
                <div class="card-body text-center">
                    <h1>0</h1>
                    <p class="text-secondary">DESCARGAS DE MEMORIAS</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h1>Asistieron</h1>
                    <p>0</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h1>Registros por Tiquete</h1>
                    <p>0</p>
                </div>
            </div>
        </div>
    </div>
@endsection