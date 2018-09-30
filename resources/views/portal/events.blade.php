@extends('layouts.portal')

@section('content')
    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center"><i class="icon-calendar"></i> Mas Eventos</h1>
                    <hr>
                    <div class="row">
                        @foreach($events as $event)
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <p><strong class="badge badge-success">{{ $event->company->name }}</strong></p>
                                                <div class="d-flex justify-content-between">
                                                    <p><strong>{{ $event->title }}</strong></p>
                                                    <div><i class="icon-calendar"></i> {{ $event->start_date->toFormattedDateString() }}</div>
                                                    @if($event->start_date > now() && $event->page)
                                                        <div><a class="badge badge-warning" href="{{ url('evento/' . $event->id . '/' . $event->page->id ) }}" target="_blank">Ir a la web <i class="fa fa-external-link" aria-hidden="true"></i></a></div>
                                                    @endif
                                                </div>
                                                <div class="row justify-content-center mb-3">
                                                    <div class="col-6">
                                                        <img src="{{ ($event->flyer) ?url($event->flyer):'http://cdn.cavemancircus.com//wp-content/uploads/images/2015/january/karlee_grey/karlee_grey_8.jpg' }}" class="img-fluid" style="min-width: 100%; min-height:150px"  alt="">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-10 offset-1 text-center">

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