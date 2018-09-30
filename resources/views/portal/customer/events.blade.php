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
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div><i class="icon-calendar"></i> {{ $event->start_date->toFormattedDateString() }}</div>
                                        <div><strong>{{ $event->title }}</strong></div>
                                        @if($event->start_date > now() && $event->page)
                                            <div><a class="badge badge-warning" href="{{ url('evento/' . $event->id . '/' . $event->page->id ) }}" target="_blank">Ir a la web <i class="fa fa-external-link" aria-hidden="true"></i></a></div>
                                        @endif
                                    </div>
                                    <a class="btn btn-block btn-outline-info rounded" href="{{ route('customer.events.order',[$detail->order_id]) }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        Ver compra</a>
                                    <hr>
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