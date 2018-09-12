@extends('layouts.portal')
@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-right"><a href="{{ route('event.page',[$data['event_id'],$data['page_id']]) }}">volver a la pagina del evento</a></p>
                    <p class="h1 my-5 text-right">Detalle de Compra</p>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Evento</strong> {{ $event->title }}</p>
                            <ul class="list-unstyled">
                                <li>{{ $event->location }}</li>
                                <li>{{ $event->address }},{{ $event->cp }} - {{ $event->city }}</li>
                                <li>{{ $event->start_date }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6 text-right">
                            <p><strong>Factura para</strong></p>
                            <ul class="list-unstyled">
                                <li>{{ Auth::user()->full_name }}</li>
                                <li>{{ Auth::user()->document_type->name }} {{ Auth::user()->document }}</li>
                                <li>{{ Auth::user()->address }}, {{ Auth::user()->zip_code }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-unstyled">
                                <li>Fecha: {{ date('d-m-Y H:i:s') }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive mt-4">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Descripción</th>
                                        <th class="text-right">Cantidad</th>
                                        <th class="text-right">Coste Unitario</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $cont_ticket = 1;
                                        $total = 0;
                                    @endphp
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td scope="row">{{ $cont_ticket }}</td>
                                            <td>
                                                <strong>Tiquete: {{ $ticket->title }}</strong> - {{ $ticket->description }}
                                            </td>
                                            <td class="text-right">{{ $data_ticket[$ticket->id]['cant'] }}</td>
                                            <td class="text-right">$ {{number_format($ticket->price, 2) }}</td>
                                            <td class="text-right">$ {{number_format($data_ticket[$ticket->id]['cant'] * $ticket->price, 2) }}</td>
                                        </tr>
                                        @php
                                            $cont_ticket++;
                                            $total += $data_ticket[$ticket->id]['cant'] * $ticket->price;
                                        @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <p class="h1">Total: $ {{ number_format($total, 2) }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <hr>
                        <button class="btn btn-success btn-lg rounded">Pagar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
