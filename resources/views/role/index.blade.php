@extends('layouts.main')
@section('content')
    @if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <div class="row mt-5">
        <div class="col-12">
            <a href="{{ url('role/create') }}" class="btn btn-sm btn-success">Nuevo rol</a>
        </div>
    </div>
    <div class="row mt-3 justify-content-center align-content-center">
        @foreach($roles as $role)
        <div class="col-auto">
            <div class="card">
                <div class="card-body">
                    <a href="" class="card-link">
                        <h3 class="text-success text-center">{{ ucfirst($role->name) }}</h3>
                        <p class="text-secondary">{{ $role->description }}</p>
                    </a>
                </div>
                <div class="card-footer d-flex justify-content-around">
                    <a href="{{ url("role/$role->id/edit") }}" class="btn btn-primary rounded-circle btn-sm mb-2 mr-2"><i class="fa fa-pencil"></i></a>
                    <button type="button" class="btn btn-danger rounded-circle btn-sm mb-2" data-toggle="modal" data-target="#deleteModal" data-role_id="{{ $role->id }}">
                        <i class="fa fa-eraser" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
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
                    <button type="button" class="btn btn-secondary btn-sm text-light" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let recipient = button.data('role_id');
            let modal = $(this);
            modal.find('form').attr('action', 'role/' + recipient);
        });
    </script>
@endsection
