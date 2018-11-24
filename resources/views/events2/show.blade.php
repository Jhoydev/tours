@extends('layouts.template.melody')
@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @push('sidebar')
    @include('events.sidebar')
    @endpush

    <div class="row pt-5">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-body text-center">
                    <h1>{{ count($event->ordersPaid) }}</h1>
                    <span class="badge badge-pill badge-primary">ORDENES PAGADAS</span>
                </div>
            </div>
        </div>
        <div class="col-md-auto">
            <div class="card">
                <div class="card-body text-center">
                    <h1>{{ count($event->ordersPending) }}</h1>
                    <span class="badge badge-pill badge-warning">ORDENES PENDIENTES</span>
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
        <div class="col-md-auto">
            <div class="card">
                <div class="card-body text-center">
                    <h1>{{ $pending_tickets }}</h1>
                    <span class="badge badge-pill badge-warning">TIQUETES PENDIENTES</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h1>Tiquetes Confirmados</h1>
                    <p>{{ $attended }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection