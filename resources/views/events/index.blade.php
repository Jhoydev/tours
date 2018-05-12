@extends('layouts.main')
@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <a href="{{ url('events/create') }}" class="text-success">
                        <span class="fa-stack fa-lg ">
                            <i class="fa fa-circle fa-stack-2x "></i>
                            <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <h2 class="ml-3">Listado de eventos</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>location</th>
                            <th>start_date</th>
                            <th>end_date</th>
                            <th>falta</th>
                            <th>event_type</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->id }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->location }}</td>
                                <td>{{ $event->start_date }}</td>
                                <td>{{ $event->end_date }}</td>
                                <td>{{ $event->end_date->diffForHumans(null,true) }}</td>
                                <td>{{ $event->event_type->name }}</td>
                                <td class="text-center">
                                    <a href="{{ url("events/$event->id") }}" class="text-success">
                                        <span class="fa-stack fa-lg ">
                                            <i class="fa fa-circle fa-stack-2x "></i>
                                            <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>

                                    <a href="{{ url("events/$event->id/edit") }}" class="text-danger">
                                        <span class="fa-stack fa-lg ">
                                            <i class="fa fa-circle fa-stack-2x "></i>
                                            <i class="fa fa-eraser fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                    <a href="{{ url("events/$event->id/edit") }}">
                                        <span class="fa-stack fa-lg ">
                                            <i class="fa fa-circle fa-stack-2x "></i>
                                            <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection