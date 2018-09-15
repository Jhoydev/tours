@extends('layouts.main')
@section('link')
<style>
    [v-cloak] {
        display: none;
    }
</style>
@endsection
@section('content')
@push('navbar_items_right')
<li class="nav-item">
    <a href="{{ url('customer') }}" class="btn btn-light rounded mr-1"><i class="fa fa-ban"></i> Cancelar</a>
</li>
<li class="nav-item">    
    <a href="#" class="btn btn-success rounded mr-5 submit_form_button">{!! $method == 'PUT' ? '<i class="fa fa-refresh"></i> Actualizar' : '<i class="fa fa-plus"></i> Crear' !!}</a>
</li>
@endpush
<div id="customer" class="row mt-2 justify-content-center mb-5" v-cloak>
    <div class="col-md-10">
        {!! Form::open(['url' => $url_form,'method' => $method, 'id' =>'submit_form']) !!}
        <div class="card">
            <div class="card-body">
                @if ($method == 'PUT')
                <input type="hidden" name="edited_by" value="{{ Auth::user()->id }}">
                @elseif ($method == 'POST')
                <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                @else
                <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                @endif

                <input type="hidden" id="inp_first_name" name="first_name" value="{{ $customer->first_name ? $customer->first_name : old('first_name') }}">
                <input type="hidden" id="inp_last_name" name="last_name" value="{{ $customer->last_name ? $customer->last_name : old('last_name') }}">
                <input type="hidden" id="inp_document_type_id" name="document_type_id" value="{{ $customer->document_type_id ? $customer->document_type_id : old('document_type_id') }}">
                <input type="hidden" id="inp_document" name="document" value="{{ $customer->document ? $customer->document : old('document') }}">
                <input type="hidden" id="inp_email" name="email" value="{{ $customer->email ? $customer->email : old('email') }}">
                <input type="hidden" id="inp_phone" name="phone" value="{{ $customer->phone ? $customer->phone : old('phone') }}">
                <input type="hidden" id="inp_mobile" name="mobile" value="{{ $customer->mobile ? $customer->mobile : old('mobile') }}">
                <input type="hidden" id="inp_address" name="address" value="{{ $customer->address ? $customer->address : old('address') }}">
                <input type="hidden" id="inp_address2" name="address2" value="{{ $customer->address2 ? $customer->address2 : old('address2') }}">
                <input type="hidden" id="inp_city_id" name="city_id" value="{{ $customer->city_id ? $customer->city_id : old('city_id') }}">
                <input type="hidden" id="inp_state_id" name="state_id" value="{{ $customer->state_id ? $customer->state_id : old('state_id') }}">
                <input type="hidden" id="inp_zip_code" name="zip_code" value="{{ $customer->zip_code ? $customer->zip_code : old('zip_code') }}">
                <input type="hidden" id="inp_country_id" name="country_id" value="{{ $customer->country_id ? $customer->country_id : old('country_id') }}">
                <input type="hidden" id="inp_profession" name="profession" value="{{ $customer->profession ? $customer->profession : old('profession') }}">
                <input type="hidden" id="inp_workplace" name="workplace" value="{{ $customer->workplace ? $customer->workplace : old('workplace') }}">

                <div class="row">
                    <div class="col-6">
                        <h2 class="m-0">{{ $title }}</h2>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="first_name"><span class="fa fa-user"></span>   Nombre</label>
                        <input id="first_name" name="first_name" type="text" 
                               class="form-control rounded {{ $errors->has('first_name') ? ' is-invalid' : '' }}"  placeholder="Nombre" 
                               v-model="first_name" required>
                        @if ($errors->has('first_name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="last_name"><span class="fa fa-user"></span>   Apellido</label>
                        <input id="last_name" name="last_name" type="text" 
                               class="form-control rounded {{ $errors->has('last_name') ? ' is-invalid' : '' }}"  placeholder="Apellido" 
                               v-model="last_name" required>
                        @if ($errors->has('last_name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="document_type_id"><span class="fa fa-user"></span>   Tipo de Documento</label>
                                {{ Form::select('document_type_id', $document_types, $customer->document_type_id , ['class' => $errors->has('document_type_id') ? 'form-control rounded is-invalid' : 'form-control rounded' ,'required' => true]) }}
                            </div>
                            <div class="col-md-9">
                                <label for="document"><span class="fa fa-user"></span>   Documento</label>
                                <input id="document" name="document" type="text" 
                                       class="form-control rounded {{ $errors->has('document') ? ' is-invalid' : '' }}" placeholder="Documento" 
                                       v-model="document" required>
                                @if ($errors->has('document'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('document') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="email"><span class="fa fa-envelope"></span>   Correo Electronico</label>
                        <input id="email" name="email" type="email" 
                               class="form-control rounded {{ $errors->has('email') ? ' is-invalid' : '' }} " placeholder="Correo Electronico" 
                               v-model="email" required>
                        @if ($errors->has('document'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="phone"><span class="fa fa-phone"></span>   Telefono</label>
                        <input id="phone" name="phone" type="text" 
                               class="form-control rounded {{ $errors->has('phone') ? ' is-invalid' : '' }} " placeholder="Telefono" 
                               v-model="phone">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="mobile"><span class="fa fa-mobile"></span>   Celular</label>
                        <input id="mobile" name="mobile" type="text" 
                               class="form-control rounded {{ $errors->has('mobile') ? ' is-invalid' : '' }} " placeholder="Celular" 
                               v-model="mobile">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="address"><span class="fa fa-home"></span>   Direccion 1</label>
                        <input id="address" name="address" type="text" 
                               class="form-control rounded {{ $errors->has('address') ? ' is-invalid' : '' }}"  placeholder="Direccion" 
                               v-model="address" required>
                        @if ($errors->has('address'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="address2"><span class="fa fa-home"></span>   Direccion 2</label>
                        <input id="address2" name="address2" type="text" 
                               class="form-control rounded {{ $errors->has('address2') ? ' is-invalid' : '' }}"  placeholder="Direccion 2" 
                               v-model="address2">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="country_id"><span class="fa fa-map-marker"></span>   Pais</label>
                        <input id="country_id" name="country_id" type="text" 
                               class="form-control rounded {{ $errors->has('country_id') ? ' is-invalid' : '' }}"  placeholder="Pais" 
                               v-model="country_id">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="state_id"><span class="fa fa-map-marker"></span>   Estado/Departamento</label>
                        <input id="state_id" name="state_id" type="text" 
                               class="form-control rounded {{ $errors->has('state_id') ? ' is-invalid' : '' }}"  placeholder="Estado/Departamento" 
                               v-model="state_id">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="city_id"><span class="fa fa-map-marker"></span>   Ciudad</label>
                        <input id="city_id" name="city_id" type="text" 
                               class="form-control rounded {{ $errors->has('city_id') ? ' is-invalid' : '' }}"  placeholder="Ciudad" 
                               v-model="city_id">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="zip_code"><span class="fa fa-map-marker"></span>   Codigo Postal</label>
                        <input id="zip_code" name="zip_code" type="text" 
                               class="form-control rounded {{ $errors->has('zip_code') ? ' is-invalid' : '' }}"  placeholder="Codigo Postal" 
                               v-model="zip_code">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="profession"><span class="fa fa-graduation-cap"></span>   Profesion</label>
                        <input id="profession" name="profession" type="text" 
                               class="form-control rounded {{ $errors->has('profession') ? ' is-invalid' : '' }}"  placeholder="Profesion" 
                               v-model="profession">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="workplace"><span class="fa fa-building"></span>   Lugar de Trabajo</label>
                        <input id="workplace" name="workplace" type="text" 
                               class="form-control rounded {{ $errors->has('workplace') ? ' is-invalid' : '' }}"  placeholder="Lugar de Trabajo" 
                               v-model="workplace">
                    </div>
                </div>

                @if ($method == 'POST')
                <hr>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="password"><span class="fa fa-key"></span>   Contraseña</label>
                        <input autocomplete="off" id="password" name="password" type="password" 
                               class="form-control rounded {{ $errors->has('password') ? ' is-invalid' : '' }} "  placeholder="Contraseña" 
                               v-model="password" required>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="password-confirm"><span class="fa fa-key"></span>   Confirmar Contraseña</label>
                        <input autocomplete="off" id="password-confirm" name="password_confirmation" 
                               type="password" class="form-control  rounded" placeholder="Confirmar Contraseña" 
                               v-model="password_confirmation" required>
                    </div>
                </div>
                @else
                <hr>
                <input type="hidden" value="{{ $errors->has('password') ? $errors->first('password'): "" }}" id="password_error">
                <div class="form-group col-md-12 mt-3" v-show="show_password">
                    <input type="hidden" name="pass_secret" id="pass_secret" value="{{ $customer->password }}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="password"><span class="fa fa-key"></span>   Contraseña</label>
                            <input autocomplete="off" id="password" name="password" type="password" 
                                   class="form-control rounded {{ $errors->has('password') ? ' is-invalid' : '' }} "  placeholder="Contraseña" 
                                   v-model="password" required>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password-confirm"><span class="fa fa-key"></span>   Confirmar Contraseña</label>
                            <input autocomplete="off" id="password-confirm" name="password_confirmation" 
                                   type="password" class="form-control  rounded" placeholder="Confirmar Contraseña" 
                                   v-model="password_confirmation" required>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12 text-center">
                    <button class="btn btn-warning btn-sm rounded"  v-bind:class="{ 'btn-light' : btn_password_class }" type="button" v-on:click="change_password()">@{{ btn_password_text }}</button>
                </div>
                <div class="form-group col-md-12" v-show="show_password">
                    <hr>
                </div>
                @endif
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/vue/customer.js') }}"></script>
@endsection
