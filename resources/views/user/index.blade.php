@extends('layouts.main')
@section('content')
    <div class="row mt-5 justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <i class="icon-people"></i> Usuarios
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th>Usuario</th>
                            <th>Compañia</th>
                            <th>Rol</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)

                                <tr>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ ucfirst($user->company->name) }}</td>
                                    <td>{{ ucfirst(last($user->getRoles())) }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-primary btn-sm">Editar</a>
                                        <a href="{{ url('user/'.$user->id) }}" class="btn btn-success btn-sm">Ver</a>
                                        <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection