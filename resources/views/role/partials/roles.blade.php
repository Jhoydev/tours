<div class="card">
    <div class="card-body">
        <p class="h1">Roles</p>
        <table id="table_datatable" class="table">
            <thead class="thead-dark">
            <tr>
                <th>Nombre</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td scope="row">{{ ucfirst($role->name) }}</td>
                    <td class="text-right">
                        <a href="{{ url("role/$role->id/edit") }}" class="btn btn-primary rounded btn-sm mr-2"><i class="fa fa-pencil"></i> Editar</a>
                        <button type="button" class="btn btn-outline-danger rounded btn-sm" data-toggle="modal" data-target="#deleteModal" data-role_id="{{ $role->id }}">
                            <i class="fa fa-eraser" aria-hidden="true"></i> Eliminar
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
{{--<div class="row mt-2">
    @foreach($roles as $role)
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">{{ ucfirst($role->name) }}</h4>
                <hr>
                <p class="text-secondary description-block" id="description" data-toggle="tooltip" data-placement="top" title="{{ $role->description }}">{{ $role->description }}</p>
                <hr>
                <div class="d-flex justify-content-around">
                    <a href="{{ url("role/$role->id/edit") }}" class="btn btn-primary rounded btn-sm mr-2"><i class="fa fa-pencil"></i> Editar</a>
                    <button type="button" class="btn btn-outline-danger rounded btn-sm" data-toggle="modal" data-target="#deleteModal" data-role_id="{{ $role->id }}">
                        <i class="fa fa-eraser" aria-hidden="true"></i> Eliminar
                    </button>
                </div>
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
                Esta seguro de eliminar este rol?
            </div>
            <div class="modal-footer">
                {!! Form::open([ 'id' => 'form_delete' ,'url' => '','method' => 'DELETE','class' => 'd-inline-block']) !!}
                {!! Form::submit('Eliminar',['class' => 'btn btn-outline-danger btn-sm rounded'])  !!}
                {!! Form::close() !!}
                <button type="button" class="btn btn-secondary btn-sm rounded text-light" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    @include('layouts.js.datatable')
@endpush