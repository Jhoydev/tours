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
                'url_form'  => url("page/$page->id"),
                'method'    => 'PUT',
                'title'     => 'Editar página',
                'btn_title' => 'Actualizar',
                $page
            ])
    	</div>
    </div>
@endsection