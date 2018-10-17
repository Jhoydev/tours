<div class="card rounded">
    <div class="card-body">
        <h1 class="text-center">Usuarios</h1>
        <hr>
        <div class="table-responsive">
            <table id="table_datatable" class="table">
                <thead class="thead-dark">
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td><img class="img-fluid rounded-circle avatar_user" src="{{ url("user/avatar/".$user->company_id."/".$user->id) }}" alt=""></td>
                        <td>{{$user->full_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{ $user->phone }}</td>
                        <td class="text-right">
                            @can('user.edit')
                            <a href="{{ url("user/$user->id/edit") }}" class="btn btn-primary btn-sm mb-2 rounded"><i class="fa fa-pencil"></i> Editar</a>
                            @endcan
                            @can('user.destroy')
                            <button type="button" class="btn btn-outline-danger btn-sm mb-2 rounded" data-toggle="modal" data-target="#deleteModal" data-user_id="{{ $user->id }}">
                                <i class="fa fa-eraser" aria-hidden="true"></i> Eliminar
                            </button>
                            @endcan

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{--<div class="row animated bounceInRight mt-2">
    @foreach($users as $user)
    <div class="card rounded col-lg-3 col-md-4 col-sm-6 mr-1">
        <div class="card-body">
            <div class="text-center mb-2">
                <img class="img-fluid mx-auto avatar_user" src="{{ url("user/avatar/".$user->company_id."/".$user->id) }}" alt="">
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-1"><i class="icon-user"></i> {{ $user->full_name }}</li>
                <li class="list-group-item p-1"><i class="fa fa-envelope-o"></i> {{ $user->email }}</li>
                <li class="list-group-item p-1"><i class="fa fa-phone"></i> {{ $user->phone }}</li>
            </ul>
            <div class="mt-2 text-center">
                <a href="{{ url("user/$user->id/edit") }}" class="btn btn-primary rounded-circle btn-sm mb-2"><i class="fa fa-pencil"></i></a>
                <button type="button" class="btn btn-danger rounded-circle btn-sm mb-2" data-toggle="modal" data-target="#deleteModal" data-user_id="{{ $user->id }}">
                    <i class="fa fa-eraser" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
    @endforeach
</div>--}}

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Esta seguro de eliminar este usuario
            </div>
            <div class="modal-footer">
                {!! Form::open([ 'id' => 'form_delete' ,'url' => '','method' => 'DELETE','class' => 'd-inline-block']) !!}
                {!! Form::submit('Eliminar',['class' => 'btn btn-danger btn-sm'])  !!}
                {!! Form::close() !!}
                <button type="button" class="btn btn-secondary btn-sm text-light" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    @include('layouts.js.datatable')
@endpush