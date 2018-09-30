@extends('layouts.portal')
@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="h3 text-right">Factura #{{ $order->reference }}</p>
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
                            <p>Fecha de la factura: {{ now()->toFormattedDateString() }}</p>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead class="thead-dark">
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
                    <p class="text-right h5">Total $ {{ number_format($total,2)}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
