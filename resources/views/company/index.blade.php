@extends('layouts.main')
@section('content')
    <div class="row mt-5 justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="icon-people"></i> Usuarios
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Compañia</th>
                            <th>Creada</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td>{{ ucfirst($company->name) }}</td>
                                    <td>{{ $company->created_at }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-success btn-sm">Ver</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $companies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection