@extends('layouts.portal')
@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-right"><a href="{{ route('event.page',[$data['event_id'],$data['page_id']]) }}">volver a la pagina del evento</a></p>
                    <dl class="row">
                    @php
                        $cont_ticket = 1;
                        $total = 0;
                    @endphp
                    @foreach($tickets as $ticket)
                            <dt class="col-sm-3">Evento</dt>
                            <dd class="col-sm-9">{{ $ticket->event->title }}</dd>
                            <dd class="col-sm-12">{{ $ticket->event->description }}</dd>

                            <dt class="col-sm-3">Fecha del Evento</dt>
                            <dd class="col-sm-9">{{ $ticket->event->start_date }}</dd>


                            <dt class="col-sm-3">Tiquete</dt>
                            <dd class="col-sm-9">{{ $ticket->title }}</dd>

                            <dt class="col-sm-3">Precio Uni.</dt>
                            <dd class="col-sm-3">{{ $ticket->price }}</dd>
                            <dt class="col-sm-3">Cant.</dt>
                            <dd class="col-sm-3">{{ $data_ticket[$ticket->id]['cant'] }}</dd>
                            <dt class="col-sm-3">Total</dt>
                            <dd class="col-sm-3">{{ $data_ticket[$ticket->id]['cant'] * $ticket->price }}</dd>

                            <dd class="col-sm-12"><hr></dd>
                    @php
                        $cont_ticket++;
                        $total += $data_ticket[$ticket->id]['cant'] * $ticket->price;
                    @endphp
                    @endforeach
                    </dl>
                    <div class="row">
                        <div class="col-12 text-right">
                            <p class="h1">Total <span class="badge badge-warning rounded">{{ $total }}</span></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-success btn-lg rounded">Pagar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
