@extends('layouts.portal')
@section('content')
    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center"><i class="icon-calendar"></i> Eventos</h1>
                    <hr>
                    <div class="row">
                    @foreach($details as  $detail)
                        @continue(!$detail->event)
                        @php($event = $detail->event)
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div><i class="icon-calendar"></i> {{ $event->start_date->toFormattedDateString() }}</div>
                                        <div><strong>{{ $event->title }}</strong></div>
                                        @if($event->start_date > now() && $event->page)
                                            <div><a class="badge badge-warning" href="{{ url('evento/' . $event->id . '/' . $event->page->id ) }}" target="_blank">Ir a la web <i class="fa fa-external-link" aria-hidden="true"></i></a></div>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-center">
                                        @if($detail->event->event_type_id == 2)
                                            <a class="btn btn-info rounded mr-3" href="{{ route('customer.event',['id' => $detail->event_id]) }}"><i class="fa fa-home" aria-hidden="true"></i> Tablero</a>
                                        @endif
                                        <a class="btn btn-light border rounded" href="{{ route('customer.event.orders',['id' => $detail->event_id]) }}"><i class="fa fa-balance-scale" aria-hidden="true"></i>
                                            Ordenes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection