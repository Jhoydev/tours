@extends('admin.events.edit')
@section('content-event-edit')
    <div class="card">
        <div class="card-body">

            {!! Form::open(['url' => route('admin.events.update',['event' => $event->id]),'method' => 'PUT', 'id' => 'form_create_event','enctype'=>'multipart/form-data']) !!}
            @include('admin.events.partials.general')
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-12 mt-3 text-right">
        <a href="{{ route('admin.events.delete',['event' => $event->id]) }}" class="text-danger">Eliminar evento</a>
    </div>
@endsection