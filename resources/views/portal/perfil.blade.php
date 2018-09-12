@extends('layouts.portal')
@section('content')
<div class="row">
    <div class="col-12">
        <h1 class="my-3">Perfil</h1>
    </div>
    <div class="col-12">
        <div class="card rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img src="{{ asset('img/avatar_customer.png') }}" alt="" class="rounded-circle mb-5 mt-3" width="200" height="200">
                            </div>
                        </div>
                        <dl class="row">
                            <dt class="col-md-6">Correo Electronico</dt>
                            <dd class="col-md-6">{{ Auth::user()->email }}</dd>
                            <dt class="col-md-6">Celular</dt>
                            <dd class="col-md-6">{{ Auth::user()->mobile }}</dd>
                            <dt class="col-md-6">Telefono</dt>
                            <dd class="col-md-6">{{ Auth::user()->phone }}</dd>
                            <dd class="col-12">
                                <hr>
                            </dd>
                            <dt class="col-md-6">Direccion 1</dt>
                            <dd class="col-md-6">{{ Auth::user()->address }}</dd>
                            <dt class="col-md-6">Direccion 2</dt>
                            <dd class="col-md-6">{{ Auth::user()->address2 }}</dd>
                            <dt class="col-md-6">Pais</dt>
                            <dd class="col-md-6">{{--{{ Auth::user()->city->name }}--}}</dd>
                            <dt class="col-md-6">Estado/Departamento</dt>
                            <dd class="col-md-6">{{--{{ Auth::user()->city->name }}--}}</dd>
                            <dt class="col-md-6">Ciudad</dt>
                            <dd class="col-md-6">{{--{{ Auth::user()->city->name }}--}}</dd>
                            <dt class="col-md-6">Codigo Postal</dt>
                            <dd class="col-md-6">{{ Auth::user()->zip_code }}</dd>
                            <dd class="col-12">
                                <hr>
                            </dd>
                            <dt class="col-md-6">Profesion</dt>
                            <dd class="col-md-6">{{ Auth::user()->profession }}</dd>
                            <dt class="col-md-6">Lugar de Trabajo</dt>
                            <dd class="col-md-6">{{ Auth::user()->workplace }}</dd>

                        </dl>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-block btn-lg btn-primary rounded" type="button"><i class="fa fa-pencil"></i> Administrar Datos</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-12">
                                <p class="h1">{{ Auth::user()->full_name }}</p>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="h2"><i class="icon-calendar"></i> Ultimos Eventos</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p>Evento Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, provident. <i class="icon-calendar"></i> Sep 20, 2018</p>
                            </div>
                            <div class="col-12 text-center">
                                <img src="http://www.urbanui.com/melody/template/images/samples/1280x768/12.jpg" alt="" class="img-fluid" style="max-height: 400px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
