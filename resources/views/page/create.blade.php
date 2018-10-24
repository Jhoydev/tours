@extends('layouts.template.melody')
@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row justify-content-center">
    	<div class="col-md-10 mt-5">
    		@include('page.partials.form',[
                'url_form'  => url('page'),
                'method'    => 'POST',
                'title'    => 'Crear página',
                'btn_title' => 'Guardar',
                $page
            ])
    	</div>
    </div>
@endsection