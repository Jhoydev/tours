@extends('layouts.main')
@push('sidebar')
@include('events.sidebar')
@endpush
@section('content')
    <div class="row mt-5 justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Tiquete de Cortesía</h3>
                    {!! Form::open(['url' => url("events/$event->id/courtesy"),'method' => 'POST']) !!}
                    @include('events.courtesy.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection