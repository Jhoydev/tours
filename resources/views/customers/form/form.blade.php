@extends('layouts.template.melody')
@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-md-12">
        <p class="h1 my-3">Nuevo Cliente</p>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        {!! Form::open(['url' => url('customer'),'method' => 'POST','id' => 'form-customer']) !!}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="first_name"><span class="fa fa-user"></span> Nombre</label>
                                <input id="first_name" name="first_name" type="text"
                                       class="form-control rounded {{ $errors->has('first_name') ? ' is-invalid' : '' }}"  placeholder="Nombre"
                                       value="{{ $customer->first_name ? $customer->first_name : old('first_name') }}" required>
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
                                       value="{{ $customer->last_name ? $customer->last_name : old('last_name') }}" required>
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
                                        @include('viewComposers.input_document_type')
                                    </div>
                                    <div class="col-md-9">
                                        <label for="document"><span class="fa fa-user"></span>   Documento</label>
                                        <input id="document" name="document" type="text"
                                               class="form-control rounded {{ $errors->has('document') ? ' is-invalid' : '' }}" placeholder="Documento"
                                               value="{{ $customer->document ? $customer->document : old('document') }}" required>
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
                                <label for="email"><span class="fa fa-envelope"></span>   Correo Electrónico</label>
                                <input id="email" type="email" name="email"
                                       class="form-control rounded {{ $errors->has('email') ? ' is-invalid' : '' }} " placeholder="Correo Electrónico"
                                       value="{{ $customer->email ? $customer->email : old('email') }}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="phone"><span class="fa fa-phone"></span>   Teléfono</label>
                                <input id="phone" name="phone" type="text"
                                       class="form-control rounded {{ $errors->has('phone') ? ' is-invalid' : '' }} " placeholder="Teléfono"
                                       value="{{ $customer->phone ? $customer->phone : old('phone') }}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="mobile"><span class="fa fa-mobile"></span> Celular</label>
                                <input id="mobile" name="mobile" type="text"
                                       class="form-control rounded {{ $errors->has('mobile') ? ' is-invalid' : '' }} " placeholder="Celular"
                                       value="{{ $customer->mobile ? $customer->mobile : old('mobile') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="birth"><i class="fa fa-calendar" aria-hidden="true"></i> Fecha de nacimiento</label>
                                <input data-inputmask="'alias': 'date'" type="text" class="form-control" id="birth" name="birth" value="{{ $customer->birth ? $customer->birth->format('d/m/Y') : old('birthN') }}"/>
                                <label id="birth-error" class="error mt-2 text-danger invisible" for="birth">Debes de completar la fecha o dejarla vacia</label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="address"><span class="fa fa-home"></span>   Direccion 1</label>
                                <input id="address" name="address" type="text"
                                       class="form-control rounded {{ $errors->has('address') ? ' is-invalid' : '' }}"  placeholder="Direccion"
                                       value="{{ $customer->address ? $customer->address : old('address') }}" required>
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
                                       value="{{ $customer->address2 ? $customer->address2 : old('address2') }}">
                            </div>

                            @include('layouts.partials.forms.inputs_location',['input' => $customer])

                            <div class="form-group col-md-6">
                                <label for="zip_code"><span class="fa fa-map-marker"></span>   Codigo Postal</label>
                                <input id="zip_code" name="zip_code" type="text"
                                       class="form-control rounded {{ $errors->has('zip_code') ? ' is-invalid' : '' }}"  placeholder="Codigo Postal"
                                       value="{{ $customer->zip_code ? $customer->zip_code : old('zip_code') }}">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="profession"><span class="fa fa-graduation-cap"></span>   Profesion</label>
                                <input id="profession" name="profession" type="text"
                                       class="form-control rounded {{ $errors->has('profession') ? ' is-invalid' : '' }}"  placeholder="Profesion"
                                       value="{{ $customer->profession ? $customer->profession : old('profession') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="workplace"><span class="fa fa-building"></span>   Lugar de Trabajo</label>
                                <input id="workplace" name="workplace" type="text"
                                       class="form-control rounded {{ $errors->has('workplace') ? ' is-invalid' : '' }}"  placeholder="Lugar de Trabajo"
                                       value="{{ $customer->workplace ? $customer->workplace : old('workplace') }}">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password"><span class="fa fa-key"></span> Contraseña</label>
                                <input id="password" type="password" class="rounded form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password-confirm"><span class="fa fa-key"></span> {{ __('Confirmar Contraseña') }}</label>
                                <input id="password-confirm" type="password" class="form-control rounded" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save" aria-hidden="true"></i> Guardar
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#birth').blur(validarBirth);
    $('#form-customer').submit(function (ev){
        if (!validarBirth()) {
            ev.preventDefault()
        }
    });
</script>
@endpush
