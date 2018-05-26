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
                    <h3>{{ $event->title }}</h3>
                    <a href="{{ url("page/$event->id/create") }}" class="ml-auto btn btn-primary">Configurar pagina</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>location</th>
                            <th>start_date</th>
                            <th>event_type</th>
                            <th>description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->start_date }}</td>
                            <td>{{ $event->event_type->name }}</td>
                            <td>{{ $event->description }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection