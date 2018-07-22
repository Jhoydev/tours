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
                    <h2>Nuevo usuario</h2>
                </div>
                <div class="col-md-4">
                    <div class="form-row mt-3 d-flex justify-content-end">
                        <div class="form-group text-center">
                            <a href="{{ url('user') }}" class="btn btn-light"><i class="fa fa-ban"></i> Cancelar</a>
                        </div>
                        <div class="ml-5 mr-1 form-group text-center">
                            <button class="btn btn-success" type="submit">{!! $method == 'PUT' ? '<i class="fa fa-refresh"></i> Actualizar' : '<i class="fa fa-plus"></i> Crear' !!}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card card-body">
                <div class="form-row">
                    <div class="col mb-3">
                        <h5 class="text-center">Avatar</h5>
                        @if ($method == 'PUT')
                            <input type="hidden" id="img_src" value="{{ url("user/avatar/".$user->company_id."/".$user->id) }}">
                        @else
                            <input type="hidden" id="img_src" value="">
                        @endif

                        <div class="text-center">
                            <img class="img-fluid img-thumbnail" style="min-width: 150px; min-height:150px" :src="image" alt="">
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
                            <button type="button" class="btn btn-light" @click="removeImage">Cancelar</button>
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
                                   class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
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
                                   class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
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
                                   class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
                                   value="{{ $user->phone ? $user->phone : old('phone') }}" required autofocus>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email"><span class="fa fa-envelope"></span> Email</label>
                            <input id="email" type="email"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                   value="{{ $user->email ? $user->email : old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <input type="hidden" name="company" id="company" value="{{ Auth::user()->company }}">

                        @if ($method == "PUT")
                            <div class="form-group col-md-12 mt-3" v-show="show_password">

                                <input type="hidden" name="pass_secret" id="pass_secret" value="{{ $user->password }}">
                                <div class="form-group">
                                    <hr>
                                    <label for="password">Contraseña</label>
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                           v-model="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback"><strong id="error_password">{{ $errors->first('password') }}</strong></span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">Confirmar contraseña</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="c_password">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-warning btn-sm"  v-bind:class="{ 'btn-light' : btn_password_class }" type="button" v-on:click="change_password()">@{{ btn_password_text }}</button>
                            </div>
                            <div class="form-group col-md-12" v-show="show_password">
                                <hr>
                            </div>
                        @else
                            <div class="form-group col-md-6">
                                <label for="password"><span class="fa fa-key"></span> Contraseña</label>
                                <input id="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                       value="{{ $user->password ? $user->password : old('password') }}" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group  col-md-6">
                                <label for="password-confirm"><span class="fa fa-key"></span> Confirmar contraseña</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  required>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @include('layouts.form.roles')
                </div>
            </div>
        </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@section('script')
    <script src="{{ asset('js/user.js') }}"></script>
@endsection