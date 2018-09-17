@extends('layouts.main')
@section('content')
    @include('layouts.menssage_success')
    @push('sidebar')
        @include('events.sidebar')
    @endpush
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="h1">Ordenes</p>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo Electronico</th>
                            <th>Evento</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($event->orders as $order)
                            <tr>
                                <td scope="row">{{ $order->id }}</td>
                                <td>{{ $order->customer->full_name }}</td>
                                <td>{{ $order->customer->email }}</td>
                                <td>{{ $order->event->title }}</td>
                                <td>{{ $order->order_status->name }}</td>
                                <td><a href="{{ route('event.orders.details',['event' => $event->id,'order' => $order->id]) }}">ver</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection