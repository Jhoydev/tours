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
    <div class="row justify-content-center mt-5">
    	<div class="col-md-12">
    		@include('events.partials.form',[$event])
    	</div>
    </div>
@endsection