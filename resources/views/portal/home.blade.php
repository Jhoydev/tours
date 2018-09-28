@extends('layouts.portal')
@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8  mb-5">
                            <div class="row">
                                <div class="col-12">
                                    <p class="h2"><i class="icon-calendar"></i> Ultimos Eventos</p>
                                </div>
                            </div>
                            @foreach($events as $event)
                                <div class="row">
                                    <div class="col-12">
                                        <p>{{ $event->title }} <i class="icon-calendar"></i> {{ $event->start_date }}</p>
                                    </div>
                                    <div class="col-12 text-justify">
                                        <p class="text-muted">{!! $event->description !!}</p>
                                    </div>
                                    <div class="col-12 my-4">
                                        <hr>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="col-lg-4">
                            <p class="h2">{{ Auth::user()->full_name }}</p>
                            <dl class="row">
                                <dt class="col-md-6"><span class="fa fa-envelope"></span> Correo Electronico</dt>
                                <dd class="col-md-6">{{ Auth::user()->email }}</dd>
                                <dt class="col-md-6"><span class="fa fa-mobile"></span> Celular</dt>
                                <dd class="col-md-6">{{ Auth::user()->mobile }}</dd>
                                <dt class="col-md-6"><span class="fa fa-phone"></span> Telefono</dt>
                                <dd class="col-md-6">{{ Auth::user()->phone }}</dd>
                                <dd class="col-12">
                                    <hr>
                                </dd>
                                <dt class="col-md-6"><span class="fa fa-map-marker"></span> Dirección</dt>
                                <dd class="col-md-6">{{ Auth::user()->address }}</dd>
                                <dt class="col-md-6"><span class="fa fa-map-marker"></span> Direccion 2</dt>
                                <dd class="col-md-6">{{ Auth::user()->address2 }}</dd>
                                <dt class="col-md-6"><span class="fa fa-map-marker"></span> Pais</dt>
                                <dd class="col-md-6">{{ Auth::user()->country->name }}</dd>
                                <dt class="col-md-6"><span class="fa fa-map-marker"></span> Estado/Departamento</dt>
                                <dd class="col-md-6">{{ Auth::user()->state->name }}</dd>
                                <dt class="col-md-6"><span class="fa fa-map-marker"></span> Ciudad</dt>
                                <dd class="col-md-6">{{ Auth::user()->city->name }}</dd>
                                <dt class="col-md-6"><span class="fa fa-map-marker"></span> Codigo Postal</dt>
                                <dd class="col-md-6">{{ Auth::user()->zip_code }}</dd>
                                <dd class="col-12">
                                    <hr>
                                </dd>
                                <dt class="col-md-6"><i class="fa fa-briefcase" aria-hidden="true"></i> Profesion</dt>
                                <dd class="col-md-6">{{ Auth::user()->profession }}</dd>
                                <dt class="col-md-6"><span class="fa fa-map-marker"></span> Lugar de Trabajo</dt>
                                <dd class="col-md-6">{{ Auth::user()->workplace }}</dd>

                            </dl>
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ route('profile') }}" class="btn btn-block btn-lg btn-primary rounded"><i class="fa fa-pencil"></i> Administrar Datos</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
