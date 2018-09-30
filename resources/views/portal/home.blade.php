@extends('layouts.portal')
@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8  mb-5">
                            <input type="hidden" id="url-calendar" value="{{ url('api/calendar/customer/'.Auth::user()->id) }}">
                            <div id='calendar'></div>
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
                                <dt class="col-md-6"><span class="fa fa-map-marker"></span> Dirección 2</dt>
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
@push('scripts')
    <script>
        $(document).ready(function () {
            $("#calendar").fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month'
                },
                events: {
                    url: document.querySelector('#url-calendar').value,
                }
            });
        })
    </script>
@endpush