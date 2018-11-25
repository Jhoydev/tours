<div class="card rounded">
    <div class="card-body">
        <p class="display-4 text-center"><i class="fa fa-user" aria-hidden="true"></i> Usuarios</p>
        <hr>
        <div class="table-responsive">
            <table id="table_datatable" class="table dataTable fade">
                <thead class="bg-primary text-white">
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
                            <a href="{{ route("admin.user.edit",['user' => $user->id]) }}" class="btn btn-info mb-2"><i class="fa fa-pencil-alt"></i></a>
                            @endcan
                            @can('user.destroy')
                            <button type="button" class="btn btn-outline-danger mb-2" data-toggle="modal" data-target="#deleteModal" data-user_id="{{ $user->id }}">
                                <i class="fa fa-eraser" aria-hidden="true"></i>
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
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    @include('layouts.js.datatable')
@endpush