@extends('layouts.main')
@push('sidebar')
    @include('events.sidebar')
@endpush
@section('content')
    <div class="row justify-content-center mt-5">
    	<div class="col-md-12">
    		@include('events.partials.form',[$event])
    	</div>
    </div>
@endsection