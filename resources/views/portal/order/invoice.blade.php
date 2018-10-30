@extends('layouts.portal')
@section('content')
    <div class="row">
        @if ($order->event->post_order_display_message)
        <div class="col-12 mb-3">
            <div class="alert alert-info" role="alert">
                <ul class="list-unstyled">
                    <li class="media">
                        <i class="fa fa-info-circle mr-3" style="font-size: 36px" aria-hidden="true"></i>
                        <div class="media-body">
                            <strong> {{ $order->event->post_order_display_message }}</strong>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        @endif
        <div class="col-12 mb-3 text-right">
            <a class="btn btn-success rounded" href="{{ route('customer.event.order',['event'=>$order->event_id,'order'=>$order->id]) }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Tiquetes</a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body pb-5">
                    <div class="d-flex justify-content-end align-items-end">
                        <span class="badge badge-danger badge-pill mr-2">{{ $order->order_status->name }}</span>
                        <span class="h3 m-0 text-right"> Factura #{{ $order->id }}</span>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><strong>{{ $order->event->company->name }}</strong></li>
                                <li>{{ $order->event->title }}</li>
                                <li>{{ $order->event->address }}, {{ $order->event->cp }}</li>
                            </ul>
                        </div>
                        <div class="col-lg-6 text-right">
                            <ul class="list-unstyled">
                                <li><strong>Para</strong></li>
                                <li>{{ $order->customer->full_name }}</li>
                                <li>{{ $order->customer->document }}</li>
                                <li>{{ $order->customer->email }}</li>
                                <li>{{ $order->customer->phone }}</li>
                                <li>{{ $order->customer->mobile }}</li>
                            </ul>
                        </div>
                        <div class="col-lg-12">
                            <p>Fecha de la factura: {{ $order->created_at->toDateTimeString() }}</p>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th>#</th>
                                <th>Descripción</th>
                                <th class="text-right">Cantidad</th>
                                <th class="text-right">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $cont_ticket = 1;
                                $total = 0;
                            @endphp
                            @foreach($order->orderDetails as $orderDetail)
                                <tr>
                                    <td scope="row">{{ $cont_ticket }}</td>
                                    <td>
                                        <strong>{{ $orderDetail->ticket->event->title }}</strong><br>
                                        <strong>Tiquete: {{ $orderDetail->ticket->title }}</strong> {{ $orderDetail->ticket->description }}
                                    </td>
                                    <td class="text-right">1</td>
                                    <td class="text-right">$ {{ number_format($orderDetail->ticket->price,2) }}</td>
                                </tr>
                                @php
                                    $cont_ticket++;
                                    $total += $orderDetail->ticket->price;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="text-right h4">Total $ {{ number_format($total,2)}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
