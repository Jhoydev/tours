@extends('layouts.main')
@section('content')
    <form method="post" action="{{ url('user') }}">
        @csrf
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-8 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row justify-content-center">
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="first_name">Nombre</label>
                                        <input id="first_name" type="text"
                                               class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                               name="first_name" value="{{ old('first_name') }}" required autofocus>
                                        @if ($errors->has('first_name'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="last_name">Apellidos</label>
                                        <input id="last_name" type="text"
                                               class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                               name="last_name" value="{{ old('last_name') }}" required autofocus>
                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="phone">Telefono</label>
                                        <input id="phone" type="text"
                                               class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"
                                               value="{{ old('phone') }}" required autofocus>
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="email">Email</label>
                                            <input id="email" type="email"
                                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                                                   value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        @if (Auth::user()->isInsignia())
                                            <div class="form-group col-md-12">
                                                <label for="company_id">Compañia</label>
                                                {{ Form::select('company_id', ['' => ''] + $companies, null, ['class' => "form-control",'required' => true]) }}
                                            </div>
                                        @else
                                            <input type="hidden" name="company_id" id="company_id"
                                                   value="{{ Auth::user()->company_id }}">
                                        @endif
                                        <div class="form-group col-md-12">
                                            <label for="password">password</label>
                                            <input id="password" type="password"
                                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   name="password" value="{{ old('password') }}" required>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="password-confirm">password-confirm</label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="offset-lg-1 col-lg-6">
                                <div class="form-row">
                                    <div class="col-3 mb-3">
                                        <h5>Avatar</h5>
                                        <img class="img-fluid img-thumbnail" src="https://cdn0.iconfinder.com/data/icons/avatars-6/500/Avatar_boy_man_people_account_boss_client_beard_male_person_user-512.png" alt="">
                                    </div>
                                </div>
                                <div id="roles" class="form-row">
                                    <input type="hidden" id="url_roles" value="{{ url('user/roles') }}">
                                    <input type="hidden" id="url_permissions" value="{{ url('user/permissions') }}">
                                    <div class="col-12 mb-3">
                                        <h5>Rol</h5>
                                        <div v-for="role in roles" class="form-check">
                                            <input class="form-check-input" type="radio" name="role_id" :id="role.slug"  v-model="rolepicked" :value="role.id" v-on:change="getPermissions">
                                            <label class="form-check-label" :for="role.slug ">
                                                <strong>@{{ role.name }}</strong> @{{ role.description }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h5>Permisos</h5>
                                        <div v-for="permission in list_permissions"  class="form-check">
                                            <input class="form-check-input" type="checkbox"  :id="permission.slug" :name="permission.slug" v-model="permission.checked"  :disabled="permission.disabled">
                                            <label class="form-check-label" for="defaultCheck1">
                                                @{{ permission.description }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-5">
                            <div class="form-group col-12 text-center">
                                <button class="btn btn-success btn-lg btn-block" type="submit">Crear</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection