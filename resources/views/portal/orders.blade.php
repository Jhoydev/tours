@extends('layouts.portal')
@section('content')
    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="text-center"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Ordenes</h1>
                            <hr>
                            <table id="table_datatable" class="table fade">
                                <thead class="thead-dark">
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Evento</th>
                                    <th>Valor</th>
                                    <th>Medio de Pago</th>
                                    <th class="text-center">Estado</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr class="text-center">
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->customer->full_name }}</td>
                                        <td>{{ $order->event->title }}</td>
                                        <td class="text-right">${{ number_format($order->price,2) }}</td>
                                        <td class="text-center"><span class="badge badge-info text-white">{{ ($order->transaction_id) ? 'online' : 'En efectivo' }}</span></td>
                                        <td class="text-center td-status">
                                            @if($order->order_status_id == 2)
                                                <button class="btn btn-warning text-white btn-sm rounded" onclick="confirmOrder({{ $order->id }})">
                                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                    {{ $order->order_status->name }}</button>
                                            @else
                                                <span class="badge badge-success">{{ $order->order_status->name }}</span>
                                            @endif
                                        </td>
                                        <td class="text-right"><a class="btn btn-sm btn-success rounded" href="{{ route('customer.event.order',['event' => $order->event->id,'order' => $order->id]) }}"><i class="fa fa-sign-in" aria-hidden="true"></i> ver</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@include('layouts.js.datatable')
@endpush