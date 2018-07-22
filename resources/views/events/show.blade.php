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
                <table class="table">
                    <thead>
                    <tr>
                        <th class="d-sm-none d-md-table-cell">id</th>
                        <th>title</th>
                        <th>location</th>
                        <th>start_date</th>
                        <th>event_type</th>
                        <th class="d-sm-none d-md-table-cell">description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="d-sm-none d-md-table-cell">{{ $event->id }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->start_date }}</td>
                        <td>{{ $event->event_type->name }}</td>
                        <td class="d-sm-none d-md-table-cell">{{ $event->description }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        @if (count($event->prices))
            <div class="col-md-12">
                <h3>Precios</h3>
            </div>
            @foreach ($event->prices as $price)
                <div class="col-md-2 col-sm-6 text-center">
                    <div class="card">
                        <div class="card-header">
                            {{ $price->name }}
                        </div>
                        <div class="card-body">
                            <h4>$ {{ $price->amount }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection