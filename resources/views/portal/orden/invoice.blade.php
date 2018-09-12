@extends('layouts.portal')
@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-right"><a href="{{ route('event.page',[$data['event_id'],$data['page_id']]) }}">volver a la pagina del evento</a></p>
                    <p class="h3">Detalle de compra</p>
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
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
                                        <strong>{{ $ticket->event->title }}</strong> {{ $ticket->event->description }}<br>
                                        <strong>Tiquete: {{ $ticket->title }}</strong> {{ $ticket->description }}
                                    </td>
                                    <td class="text-right">{{ $data_ticket[$ticket->id]['cant'] }}</td>
                                    <td class="text-right">{{ $ticket->price }}</td>
                                    <td class="text-right">{{ $data_ticket[$ticket->id]['cant'] * $ticket->price }}</td>
                                </tr>
                                @php
                                    $cont_ticket++;
                                    $total += $data_ticket[$ticket->id]['cant'] * $ticket->price;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="text-right h5">Total {{ $total }}</p>
                    <hr>
                    <div class="text-right">
                        <button class="btn btn-success btn-lg rounded">Pagar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
