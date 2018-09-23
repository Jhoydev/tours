@extends('layouts.portal')
@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="h3">Factura: {{ $order->reference }}</p>
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
                                        <strong>{{ $orderDetail->ticket->event->title }}</strong> {{ $orderDetail->ticket->event->description }}<br>
                                        <strong>Tiquete: {{ $orderDetail->ticket->title }}</strong> {{ $orderDetail->ticket->description }}
                                    </td>
                                    <td class="text-right">1</td>
                                    <td class="text-right">{{ $orderDetail->ticket->price }}</td>
                                </tr>
                                @php
                                    $cont_ticket++;
                                    $total += $orderDetail->ticket->price;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="text-right h5">Total $ {{ $total }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
