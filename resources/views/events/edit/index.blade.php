@extends('events.edit')
@section('content-event-edit')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['url' => url("events/$event->id"),'method' => 'PUT', 'id' => 'form_create_event','enctype'=>'multipart/form-data']) !!}
            @include('events.partials.general')
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-12 mt-3">
        <a href="{{ url("events/$event->id/confirm-delete") }}" class="text-danger">Eliminar evento</a>
    </div>
@endsection