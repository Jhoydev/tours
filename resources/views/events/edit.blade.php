@extends('layouts.template.melody')
@push('sidebar')
    @include('events.sidebar')
@endpush
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-12">
            @include('layouts.menssage_success')
        </div>
        <div class="col-12">
            @include('events.partials.nav_edit')
        </div>
    	<div class="col-md-12">
    		@yield('content-event-edit')
    	</div>
    </div>
@endsection