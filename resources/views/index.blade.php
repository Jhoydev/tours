@extends('layouts.portal')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center mb-4"><i class="icon-calendar"></i> Ver Eventos</h1>
                    <div class="row">
                        @foreach($events as $event)
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <p><strong class="badge badge-pill badge-success">{{ $event->company->name }}</strong></p>
                                                <div class="row mb-3 text-center">
                                                    <div class="col-md-4 text-md-left mb-3">
                                                        <strong>{{ $event->title }}</strong>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <div><i class="icon-calendar"></i> {{ $event->start_date->toFormattedDateString() }}</div>
                                                    </div>
                                                    <div class="col-md-4 text-md-right mb-3">
                                                        @if($event->start_date > now() && $event->page && $event->page->slug)
                                                            <div><a class="badge badge-pill badge-warning" href="{{ url('evento/' . $event->page->slug ) }}" target="_blank">Ir a la web <i class="fa fa-external-link-alt" aria-hidden="true"></i></a></div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if($event->flyer)
                                                    <div class="row justify-content-center mb-3">
                                                        <div class="col-6">
                                                            <img src="{{ ($event->flyer) ?url($event->flyer):'' }}" class="img-fluid shadow" style="min-width: 100%; min-height:150px"  alt="">
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="col-10 offset-1 text-center">
                                                <p class="text-muted">{!! $event->description !!}</p>
                                            </div>
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