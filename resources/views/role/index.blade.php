@extends('layouts.main')
@section('content')
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    {{ $roles }}
@endsection
@section('script')
@endsection
