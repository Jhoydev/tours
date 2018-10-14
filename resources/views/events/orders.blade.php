@extends('layouts.main')
@section('content')
    @include('layouts.menssage_success')
    @push('sidebar')
        @include('events.sidebar')
    @endpush
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="h4 text-center">{{ $event->title }}</p>
                    <p class="h1 text-center">Ordenes</p>
                    <hr>
                    <table id="table_datatable" class="table">
                        <thead class="thead-dark">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo Electrónico</th>
                            <th>Valor</th>
                            <th class="text-center">Estado</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($event->orders as $order)
                            <tr class="text-center">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer->full_name }}</td>
                                <td>{{ $order->customer->email }}</td>
                                <td class="text-right">${{ number_format($order->price,2) }}</td>
                                <td class="text-center"><span class="badge badge-warning">{{ $order->order_status->name }}</span></td>
                                <td class="text-right"><a class="btn btn-sm btn-success rounded" href="{{ route('event.orders.details',['event' => $event->id,'order' => $order->id]) }}"><i class="fa fa-sign-in" aria-hidden="true"></i> ver</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('layouts.js.datatable')
@endpush