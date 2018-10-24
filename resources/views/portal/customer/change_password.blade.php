@extends('layouts.portal')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row d-flex justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['url' => route('customer.update.password'),'method' => 'PUT','id' => 'form-customer-password']) !!}
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="password-old">Contraseña Actual</label>
                            <input type="password" class="form-control rounded" id="password-old" name="current_password">
                        </div>
                        <div class="col-12 form-group">
                            <label for="password">Nueva Contraseña</label>
                            <input type="password" class="form-control rounded" id="password" name="password">
                        </div>
                        <div class="col-12 form-group">
                            <label for="password_confirmation">Confirmar Contraseña</label>
                            <input type="password" class="form-control rounded" id="password_confirmation" name="password_confirmation">
                        </div>
                        <div class="col-12 form-group">
                            <button class="btn btn-success rounded" type="submit"><i class="fa fa-save"></i> Guardar</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection