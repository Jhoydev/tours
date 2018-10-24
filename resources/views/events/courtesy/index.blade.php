@extends('layouts.template.melody')
@push('sidebar')
    @include('events.sidebar')
@endpush
@section('content')
    <div class="row">
        <div class="col-12 mb-3 text-right">
            <a class="btn btn-success rounded" href="{{ url("events/$event->id/courtesy/create") }}"><i class="fa fa-plus" aria-hidden="true"></i> Crear Tiquete de Cortesía</a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(count($courtesies))
                    <div class="row">
                        @foreach($courtesies as $courtesy)
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-end-end">
                                        <strong>{{ $courtesy->name }}</strong>
                                        <a class="btn btn-sm btn-info rounded text-white" href="{{ url("events/$event->id/courtesy/$courtesy->id/edit") }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                                    </div>
                                    <div class="card-body">
                                        <p>{!! $courtesy->description !!}</p>
                                        <a class="btn btn-success btn-block rounded" href="{{ url("events/$event->id/courtesy/$courtesy->id") }}"><i class="fa fa-users" aria-hidden="true"></i> Asignar a un asistente</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @else
                        <div class="row">
                            <div class="col-12 text-center">
                                <p>Aun no hay tiquetes de cortesia creados</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection