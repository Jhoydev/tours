@extends('layouts.template.melody')
@push('sidebar')
    @include('admin.events.sidebar')
@endpush
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            @include('layouts.menssage_success')
        </div>
        <div class="col-12">
            @include('admin.events.partials.nav_edit')
        </div>
    	<div class="col-md-12">
    		@yield('content-event-edit')
    	</div>
    </div>
@endsection