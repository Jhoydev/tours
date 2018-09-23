@extends('events.edit')
@section('content-event-edit')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['url' => url("events/$event->id"),'method' => 'PUT', 'id' => 'form_create_event','enctype'=>'multipart/form-data']) !!}
            @include('events.partials.general')
            {!! Form::close() !!}
        </div>
        </div>
    </div>
@endsection