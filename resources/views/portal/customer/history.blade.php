@extends('layouts.portal')
@section('content')
    <div class="row d-flex justify-content-center">
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
                                    <p><strong class="badge badge-pill badge-success">{{ $event->company->name }}</strong></p>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div><i class="icon-calendar"></i> {{ $event->start_date->toFormattedDateString() }}</div>
                                        <div><strong>{{ $event->title }}</strong></div>
                                        @if($event->start_date > now() && $event->page && $event->page->slug)
                                            <div><a class="badge badge-pill badge-warning" href="{{ url('evento/' . $event->page->slug ) }}" target="_blank">Ir a la web <i class="fa fa-external-link" aria-hidden="true"></i></a></div>
                                        @endif
                                    </div>
                                    <hr>
                                    @if($event->flyer)
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-md-6">
                                                <img src="{{ ($event->flyer) ?url($event->flyer):'' }}" class="img-fluid shadow" style="min-width: 100%; min-height:150px"  alt="">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-center">
                                            @if ($event->isActive())
                                                <a class="btn btn-primary rounded mr-3" data-toggle="tooltip" data-placement="top" title="Panel de Control" href="{{ route('customer.event',['id' => $event->id]) }}"><i class="fa fa-home" aria-hidden="true"></i></a>
                                            @endif
                                            @if($event->memories_url)
                                                <a href="{{ $event->memories_url }}" target="_blank" class="btn btn-light border rounded mr-3" data-toggle="tooltip" data-placement="top" title="Descargar Memorias"><i class="fa fa-download" aria-hidden="true"></i></a>
                                            @endif
                                        {{--<button class="btn btn-light border rounded mr-3" data-toggle="tooltip" data-placement="top" title="Descargar Certificado"><i class="fa fa-download" aria-hidden="true"></i></button>--}}
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