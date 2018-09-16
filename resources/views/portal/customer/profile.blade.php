@extends('layouts.portal')
@section('content')
@push('sidebar')
    <li class="nav-item">
        <a class="nav-link" href="{{ route("customer.changepassword") }}"><i class="icon-key"></i> Cambiar Contraseña</a>
    </li>
@endpush
@push('navbar_items_right')
    <li class="nav-item">
        <button class="btn btn-success rounded mr-5" type="button" onclick="$('#form-customer').submit()"><i class="fa fa-save"></i> Guardar</button>
    </li>
@endpush
<div class="row">
    <div class="col-12">
        <h1 class="my-3">Perfil</h1>
    </div>
    <div class="col-12">
        <div class="card rounded">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                {{--<img src="{{ asset('img/avatar_customer.png') }}" alt="" class="rounded-circle mb-5 mt-3" width="200" height="200">--}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                {!! Form::open(['url' => route('profile.update',['id' => $customer->id]),'method' => 'PUT','id' => 'form-customer']) !!}

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
                                    <div class="form-group col-md-4 info" data-toggle="tooltip" data-placement="top" title="Para cambiar el correo electronico debe solicitarlo a soporte@joinapp.com">
                                        <label for="email"><span class="fa fa-envelope"></span>   Correo Electronico</label>
                                        <input id="email" type="email"
                                               class="form-control rounded {{ $errors->has('email') ? ' is-invalid' : '' }} " placeholder="Correo Electronico"
                                               value="{{ $customer->email ? $customer->email : old('email') }}" readonly>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="phone"><span class="fa fa-phone"></span>   Telefono</label>
                                        <input id="phone" name="phone" type="text"
                                               class="form-control rounded {{ $errors->has('phone') ? ' is-invalid' : '' }} " placeholder="Telefono"
                                               value="{{ $customer->phone ? $customer->phone : old('phone') }}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="mobile"><span class="fa fa-mobile"></span> Celular</label>
                                        <input id="mobile" name="mobile" type="text"
                                               class="form-control rounded {{ $errors->has('mobile') ? ' is-invalid' : '' }} " placeholder="Celular"
                                               value="{{ $customer->mobile ? $customer->mobile : old('mobile') }}">
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

                                    <div class="form-group col-md-6">
                                        <label for="country_id"><span class="fa fa-map-marker"></span>   Pais</label>
                                        @include('viewComposers.input_country')
                                    </div>

                                    <div class="form-group col-md-6">
                                        <input type="hidden" id="url_states" value="{{ url('api/states') }}">
                                        <input type="hidden" id="value_state_id" value="{{ $customer->state->id }}">
                                        <label for="state_id"><span class="fa fa-map-marker"></span>   Estado/Departamento</label>
                                        {!!Form::select('state_id', ['' => ''], '', ['id' => 'state_id', 'class' => "form-control rounded"])!!}
                                    </div>

                                    <div class="form-group col-md-6">
                                        <input type="hidden" id="url_cities" value="{{ url('api/cities') }}">
                                        <input type="hidden" id="value_city_id" value="{{ $customer->city_id }}">

                                        <label for="city_id"><span class="fa fa-map-marker"></span>   Ciudad</label>
                                        {!!Form::select('city_id', ['' => ''], '', ['id' => 'city_id', 'class' => "form-control rounded"])!!}

                                    </div>

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
                                {!! Form::close() !!}
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
            getSates();
        });

        $("#inp_country").change(function(){
            let id = this.value;
            let url = $('#url_states').val() + "/" + id;
            let text = "";
            let sel = $('#state_id');
            $.get(url,(res)=>{
                sel.html(text);
                text += `<option value=""></option>`;
                $(res).each(function(index,val) {
                    text += `<option value="${val.id}">${val.name}</option>`;
                });
                sel.html(text);
                $('#city_id').html('');
            })
        });

        $("#state_id").change(function(){
            let id = this.value;
            let url = $('#url_cities').val() + "/" + id;
            let text = "";
            let sel = $('#city_id');
            $.get(url,(res)=>{
                sel.html(text);
                text += `<option value=""></option>`;
                $(res).each(function(index,val) {
                    text += `<option value="${val.id}">${val.name}</option>`;
                });
                sel.html(text);
            })
        });

        function getSates(){
            let country_id = $("#inp_country").val();
            let url = $('#url_states').val() + "/" + country_id;
            let id = $('#value_state_id').val();
            let text = "";
            let sel = $('#state_id');
            $.get(url,(res)=>{
                let selected = "";
                $(res).each(function(index,val) {
                    if (val.id == id){
                        selected = "selected";
                    }
                    text += `<option value="${val.id}" ${selected}>${val.name}</option>`;
                    selected = "";
                });
                sel.html(text);
                getCities();
            })
        }
        function getCities(){
            let state_id = $("#state_id").val();
            let url = $('#url_cities').val() + "/" + state_id;
            let id = $('#value_city_id').val();
            let text = "";
            let sel = $('#city_id');
            $.get(url,(res)=>{
                let selected = "";
                $(res).each(function(index,val) {
                    if (val.id == id){
                        selected = "selected";
                    }
                    text += `<option value="${val.id}" ${selected}>${val.name}</option>`;
                    selected = "";
                });
                sel.html(text);
            })
        }
    </script>
@endpush