@extends('layouts.main')
@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row justify-content-center">
    	<div class="col-md-10 mt-5">
    		@include('events.partials.form',[
                'url_form'  => url('events'), 
                'method'    => 'POST',
                'btn_name'  => 'Crear',
                $event  
            ])
    	</div>
    </div>
@endsection