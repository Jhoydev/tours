@extends('layouts.main')
@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row justify-content-center mt-5">
    	<div class="col-md-10 mb-2">
    		@include('events.partials.form',[
                'url_form'  => url("events/$event->id"),
                'method'    => 'PUT',
                'btn_name'  => 'Actualizar',
                $event  
            ])
    	</div>
        <div class="col-md-2">
            <a href="{{ url("events/$event->id/prices") }}" class="bg-white btn btn-light btn-lg border border-secondary"><i class="fa fa-money text-success"></i> Establecer precios</a>
        </div>
    </div>
@endsection