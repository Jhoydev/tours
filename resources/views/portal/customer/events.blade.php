@extends('layouts.portal')
@section('content')
    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    @foreach($orders as $order)
                        @php($event = $order->event)
                        <div class="row mb-3">
                            <div class="col-12">
                                <p>
                                    {{ $event->title }} <i class="icon-calendar"></i> {{ $event->start_date }}
                                    @if($event->start_date > now() && $event->page)
                                        <a href="{{ url('evento/' . $event->id . '/' . $event->page->id ) }}" target="_blank">WEB</a>
                                    @endif
                                </p>
                                <p>{{ $order->reference }}</p>
                                <a href="{{ route('customer.events.order',[$order->id]) }}">Ver Order</a>
                                <hr>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection