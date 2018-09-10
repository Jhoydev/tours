@extends('layouts.main')
@section('link')
<style>
    [v-cloak] {
        display: none;
    }
</style>
@endsection
@section('content')
<div id="customer" class="row mt-5 justify-content-center" v-cloak>
    <div class="col-md-10">
        {!! Form::open(['url' => $url_form,'method' => $method]) !!}
        <div class="card">
            <div class="card-body">

                @if ($method == 'PUT')
                <input type="hidden" name="edited_by" value="{{ Auth::user()->id }}">
                @elseif ($method == 'POST')
                <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                @else
                <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                @endif

                <input type="hidden" id="inp_first_name" name="first_name" value="{{ $customer->first_name }}">
                <input type="hidden" id="inp_last_name" name="last_name" value="{{ $customer->last_name }}">
                <input type="hidden" id="inp_document_type_id" name="document_type_id" value="{{ $customer->document_type_id }}">
                <input type="hidden" id="inp_document" name="document" value="{{ $customer->document }}">
                <input type="hidden" id="inp_email" name="email" value="{{ $customer->email }}">
                <input type="hidden" id="inp_phone" name="phone" value="{{ $customer->phone }}">
                <input type="hidden" id="inp_mobile" name="mobile" value="{{ $customer->mobile }}">
                <input type="hidden" id="inp_address" name="address" value="{{ $customer->address }}">
                <input type="hidden" id="inp_address2" name="address2" value="{{ $customer->address2 }}">
                <input type="hidden" id="inp_city_id" name="city_id" value="{{ $customer->city_id }}">
                <input type="hidden" id="inp_state_id" name="state_id" value="{{ $customer->state_id }}">
                <input type="hidden" id="inp_zip_code" name="zip_code" value="{{ $customer->zip_code }}">
                <input type="hidden" id="inp_country_id" name="country_id" value="{{ $customer->country_id }}">
                <input type="hidden" id="inp_profession" name="profession" value="{{ $customer->profession }}">
                <input type="hidden" id="inp_workplace" name="workplace" value="{{ $customer->workplace }}">
                <input type="hidden" id="inp_password" name="password" value="{{ $customer->password }}">

                <div class="row">
                    <div class="col-6">
                        <h2 class="m-0">{{ $title }}</h2>
                    </div>
                    <div class="col-6">
                        <div class="form-row d-flex justify-content-end">
                            <div class="text-center">
                                <a href="{{ url('customer') }}" class="btn btn-light btn-sm rounded"><i class="fa fa-ban"></i> Cancelar</a>
                            </div>
                            <div class="ml-5 mr-1 text-center">
                                <button class="btn btn-success btn-sm rounded" type="submit">{!! $method == 'PUT' ? '<i class="fa fa-refresh"></i> Actualizar' : '<i class="fa fa-plus"></i> Crear' !!}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="form-group">
                    <label for="first_name">Nombre</label>
                    <input id="first_name" name="first_name" type="text" class="form-control rounded" placeholder="Nombre" v-model="first_name">
                </div>

                <div class="form-group">
                    <label for="last_name">Apellido</label>
                    <input id="last_name" name="last_name" type="text" class="form-control rounded" placeholder="Apellido" v-model="last_name">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="document_type_id">Tipo de Documento</label>
                            {{ Form::select('document_type_id', $document_types, $customer->document_type_id , ['class' => "form-control rounded",'required' => true]) }}
                        </div>
                        <div class="col-md-7">
                            <label for="document">Documento</label>
                            <input id="document" name="document" type="text" class="form-control rounded" placeholder="Documento" v-model="document">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electronico</label>
                    <input id="email" name="email" type="email" class="form-control rounded" placeholder="Correo Electronico" v-model="email">
                </div>

                <div class="form-group">
                    <label for="phone">Telefono</label>
                    <input id="phone" name="phone" type="text" class="form-control rounded" placeholder="Telefono" v-model="phone">
                </div>

                <div class="form-group">
                    <label for="mobile">Celular</label>
                    <input id="mobile" name="mobile" type="text" class="form-control rounded" placeholder="Celular" v-model="mobile">
                </div>

                <div class="form-group">
                    <label for="address">Direccion 1</label>
                    <input id="address" name="address" type="text" class="form-control rounded" placeholder="Direccion" v-model="address">
                </div>

                <div class="form-group">
                    <label for="address2">Direccion 2</label>
                    <input id="address2" name="address2" type="text" class="form-control rounded" placeholder="Direccion 2" v-model="address2">
                </div>

                <div class="form-group">
                    <label for="country_id">Pais</label>
                    <input id="country_id" name="country_id" type="text" class="form-control rounded" placeholder="Pais" v-model="country_id">
                </div>
                
                <div class="form-group">
                    <label for="state_id">Estado/Departamento</label>
                    <input id="state_id" name="state_id" type="text" class="form-control rounded" placeholder="Estado/Departamento" v-model="state_id">
                </div>

                <div class="form-group">
                    <label for="city_id">Ciudad</label>
                    <input id="city_id" name="city_id" type="text" class="form-control rounded" placeholder="Ciudad" v-model="city_id">
                </div>

                <div class="form-group">
                    <label for="zip_code">Codigo Postal</label>
                    <input id="zip_code" name="zip_code" type="text" class="form-control rounded" placeholder="Codigo Postal" v-model="zip_code">
                </div>

                <div class="form-group">
                    <label for="profession">Profesion</label>
                    <input id="profession" name="profession" type="text" class="form-control rounded" placeholder="Profesion" v-model="profession">
                </div>

                <div class="form-group">
                    <label for="workplace">Lugar de Trabajo</label>
                    <input id="workplace" name="workplace" type="text" class="form-control rounded" placeholder="Lugar de Trabajo" v-model="workplace">
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input id="password" name="password" type="password" class="form-control rounded" placeholder="Contraseña" v-model="password">
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/vue/customer.js') }}"></script>
@endsection
