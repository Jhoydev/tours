@extends('layouts.main')
@section('link')
<style>
    [v-cloak] {
        display: none;
    }
</style>
@endsection
@section('content')
<div id="role" class="row mt-5 justify-content-center" v-cloak>
    <div class="col-md-10">
        {!! Form::open(['url' => $url_form,'method' => $method]) !!}
        <div class="card">
            <div class="card-body">

                <input type="hidden" name="permissions" :value="permissionsCheked">
                <input type="hidden" name="slug" :value="nameToSlug">
                <input type="hidden" id="inp_permissions" name="role_permissions" value="{{ (isset($role_permissions) && $role_permissions) ? $role_permissions : "" }}">
                <input type="hidden" id="inp_name" name="name" value="{{ $role->name ? $role->name : old('name') }}">
                <input type="hidden" id="role-special" value="{{ $role->special ? $role->special : old('special') }}">
                <input type="hidden" id="inp_description" name="description" value="{{ $role->description ? $role->description : old('description') }}">

                <div class="row">
                    <div class="col-6">
                        <h2 class="m-0">{{ $title }}</h2>
                    </div>
                    <div class="col-6">
                        <div class="form-row d-flex justify-content-end">
                            <div class="text-center">
                                <a href="{{ url('role') }}" class="btn btn-light btn-sm rounded"><i class="fa fa-ban"></i> Cancelar</a>
                            </div>
                            <div class="ml-5 mr-1 text-center">
                                <button class="btn btn-success btn-sm rounded" type="submit">{!! $method == 'PUT' ? '<i class="fa fa-refresh"></i> Actualizar' : '<i class="fa fa-plus"></i> Crear' !!}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                
                <div class="form-group">
                    <label for="name">Nombre del rol</label>
                    <input id="name" name="name" type="text" class="form-control rounded {{ $errors->has('name') ? ' is-invalid' : '' }}" v-model="name" required>
                    @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control rounded {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" v-model="description"></textarea>
                    @if ($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>
                
                <div class="form-group">
                    <h4>Permisos</h4>
                </div>
                <div class="row">
                    <div class="col-12" v-if="special">
                        <div class="alert alert-dark" role="alert">
                            Este rol tiene ya asignados todos los permisos posibles.
                        </div>
                    </div>
                    @foreach($permissions as $permission)
                    <div class="col-auto mb-3">
                        <label class="switch switch-icon switch-pill switch-primary-outline-alt" v-bind:class="{ 'switch-secondary-outline-alt': special }">
                            <input v-model="permissions" value="{{ $permission->id }}" class="switch-input" type="checkbox" id="{{ $permission->slug }}" :disabled="special">
                            <span class="switch-label" data-on="&#10004" data-off="&#10006"></span>
                            <span class="switch-handle"></span>
                        </label>
                        <label for="{{ $permission->slug }}" :class="{'text-gray-300' : special }"> {{ $permission->name }}</label>
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
<script src="{{ asset('js/vue/role.js') }}"></script>
@endsection
