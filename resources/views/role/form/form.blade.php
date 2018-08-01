@extends('layouts.main')
@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div id="role" class="row mt-5 justify-content-center">
        <div class="col-md-10">
            {!! Form::open(['url' => $url_form,'method' => $method]) !!}
            <div class="card">
                <div class="card-body">
                    <input type="hidden" name="permissions" :value="permissionsCheked">
                    <input type="hidden" id="inp_permissions" name="role_permissions" value="{{ (isset($role_permissions) && $role_permissions) ? $role_permissions : "" }}">
                    <input type="hidden" name="slug" :value="nameToSlug">
                    <input type="hidden" id="inp_name" name="name" value="{{ $role->name }}">
                    <input type="hidden" id="inp_description" name="description" value="{{ $role->description }}">
                    <div class="row">
                        <div class="col-6">
                            <h2 class="m-0">Nuevo rol</h2>
                        </div>
                        <div class="col-6">
                            <div class="form-row d-flex justify-content-end">
                                <div class="text-center">
                                    <a href="{{ url('role') }}" class="btn btn-light"><i class="fa fa-ban"></i> Cancelar</a>
                                </div>
                                <div class="ml-5 mr-1 text-center">
                                    <button class="btn btn-success" type="submit">{!! $method == 'PUT' ? '<i class="fa fa-refresh"></i> Actualizar' : '<i class="fa fa-plus"></i> Crear' !!}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="name">Nombre del rol</label>
                        <input id="name" name="name" type="text" class="form-control" v-model="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control" name="description" id="description" v-model="description"></textarea>
                    </div>
                    <div class="form-group">
                        <h4>Permisos</h4>
                    </div>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-auto mb-3">
                                <label class="switch switch-icon switch-pill switch-primary-outline-alt">
                                    <input v-model="permissions" value="{{ $permission->id }}" class="switch-input" type="checkbox" id="{{ $permission->slug }}">
                                    <span class="switch-label" data-on="&#10004" data-off="&#10006"></span>
                                    <span class="switch-handle"></span>
                                </label>
                                <label for="{{ $permission->slug }}"> {{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/role.js') }}"></script>
@endsection
