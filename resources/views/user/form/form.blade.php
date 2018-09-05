@extends('layouts.main')

@section('link')
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
@endsection

@section('content')
    {!! Form::open(['url' => $url_form,'method' => $method,'enctype'=>'multipart/form-data']) !!}
    @csrf
    <div class="row mt-2 justify-content-center mb-5"  id="user" v-cloak>
        <div class="col-12">
            <div class="row">
                <div class="col-md-8">
                    <h2>{{ $title }}</h2>
                </div>
                <div class="col-md-4">
                    <div class="form-row mt-3 d-flex justify-content-end">
                        <div class="form-group text-center">
                            <a href="{{ url('user') }}" class="btn btn-light btn-sm rounded"><i class="fa fa-ban"></i> Cancelar</a>
                        </div>
                        <div class="ml-5 mr-1 form-group text-center">
                            <button class="btn btn-success btn-sm rounded" type="submit">{!! $method == 'PUT' ? '<i class="fa fa-refresh"></i> Actualizar' : '<i class="fa fa-plus"></i> Crear' !!}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card card-body">
                <div class="row">
                    <div class="col mb-3">
                        <h5 class="text-center">Avatar</h5>
                        <input type="hidden" name="delete_avatar" v-model="delete_avatar">
                        @if ($method == 'PUT')
                            <input type="hidden" id="img_src" value="{{ $url_avatar }}">
                        @else
                            <input type="hidden" id="img_src" value="">
                        @endif

                        <div class="text-center">
                            <img class="img-fluid img-thumbnail" style="min-width: 100%; min-height:150px" :src="image" alt="">
                        </div>
                    </div>

                    <div class="col-12 mb-3 text-center">
                        <div v-show="!image">
                            <div class="custom-file">
                                <label class="custom-file-label" for="customFile"></label>
                                <input type="file" name="avatar" class="custom-file-input" id="customFile"  @change="onFileChange">
                            </div>
                        </div>
                        <div v-if="image">
                            <button type="button" class="btn btn-sm btn-light" @click="removeImage"><i class="fa fa-ban"></i> Quitar avatar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="first_name"><span class="fa fa-user"></span> Nombre</label>
                            <input id="first_name" type="text"
                                   class="rounded form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                   name="first_name" value="{{ $user->first_name ? $user->first_name : old('first_name') }}" required
                                   autofocus>
                            @if ($errors->has('first_name'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name"><span class="fa fa-user"></span> Apellidos</label>
                            <input id="last_name" type="text"
                                   class="rounded form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                   name="last_name" value="{{ $user->last_name ? $user->last_name : old('last_name') }}" required
                                   autofocus>
                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone"><span class="fa fa-phone"></span> Telefono</label>
                            <input id="phone" type="text"
                                   class="rounded form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
                                   value="{{ $user->phone ? $user->phone : old('phone') }}" required autofocus>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="mobile"><span class="fa fa-mobile"></span> Celular</label>
                            <input id="mobile" type="text"
                                   class="rounded form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile"
                                   value="{{ $user->mobile ? $user->mobile : old('mobile') }}" required autofocus>
                            @if ($errors->has('mobile'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email"><span class="fa fa-envelope"></span> Email</label>
                            <input id="email" type="email"
                                   class="rounded form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ $user->email ? $user->email : old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="state"><span class="fa fa-map-marker"></span> Departamento</label>
                            <input id="state" type="text"
                                   class="rounded form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state"
                                   value="{{ $user->state ? $user->state : old('state') }}" required autofocus>
                            @if ($errors->has('state'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="city"><span class="fa fa-map-marker"></span> Ciudad</label>
                            <input id="city" type="text"
                                   class="rounded form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city"
                                   value="{{ $user->city ? $user->city : old('city') }}" required autofocus>
                            @if ($errors->has('city'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="address"><span class="fa fa-map-marker"></span> Domicilio</label>
                            <input id="address" type="text"
                                   class="rounded form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address"
                                   value="{{ $user->address ? $user->address : old('address') }}" required autofocus>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <input type="hidden" name="company_id" id="company_id" value="{{ Auth::user()->company_id }}">

                        @if ($method == "PUT")
                            <div class="form-group col-md-12 mt-3" v-show="show_password">

                                <input type="hidden" name="pass_secret" id="pass_secret" value="{{ $user->password }}">
                                <div class="form-group">
                                    <hr>
                                    <label for="password">Contraseña</label>
                                    <input id="password" type="password"
                                           class="rounded form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                           v-model="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback"><strong id="error_password">{{ $errors->first('password') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">Confirmar contraseña</label>
                                    <input id="password-confirm" type="password" class="rounded form-control" name="password_confirmation" v-model="c_password">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-warning btn-sm rounded"  v-bind:class="{ 'btn-light' : btn_password_class }" type="button" v-on:click="change_password()">@{{ btn_password_text }}</button>
                            </div>
                            <div class="form-group col-md-12" v-show="show_password">
                                <hr>
                            </div>
                        @else
                            <div class="form-group col-md-6">
                                <label for="password"><span class="fa fa-key"></span> Contraseña</label>
                                <input id="password" type="password"
                                       class="rounded form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                       value="{{ $user->password ? $user->password : old('password') }}" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="password-confirm"><span class="fa fa-key"></span> Confirmar contraseña</label>
                                <input id="password-confirm" type="password" class="rounded form-control" name="password_confirmation"  required>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @include('user.form.roles')
                </div>
            </div>
        </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@section('script')
    <script src="{{ asset('js/vue/user.js') }}"></script>
@endsection