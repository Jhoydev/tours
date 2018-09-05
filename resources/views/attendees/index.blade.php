@extends('layouts.main')
@section('content')
@include('layouts.menssage_success')
<div class="row mt-5">
    <div class="col-12">
        <a href="{{ url('attendee/create') }}" class="btn btn-sm btn-success rounded"><i class="fa fa-plus"></i> Nuevo Asistente</a>
    </div>
</div>
<div class="row mt-3">
    @foreach($attendees as $attendee)
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">{{ ucfirst($attendee->first_name) }} {{ ucfirst($attendee->last_name) }}</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5"><strong>Correo Electronico</strong></div>
                    <div class="col-md-7"><p class="text-secondary">{{ $attendee->email }}</p></div>
                </div>
                <div class="row">
                    <div class="col-md-5"><strong>Telefono</strong></div>
                    <div class="col-md-7"><p class="text-secondary">{{ $attendee->phone }}</p></div>
                </div>
                <div class="row">
                    <div class="col-md-5"><strong>Celular</strong></div>
                    <div class="col-md-7"><p class="text-secondary">{{ $attendee->mobile }}</p></div>
                </div>
                <div class="row">
                    <div class="col-md-5"><strong>Documento</strong></div>
                    <div class="col-md-7"><p class="text-secondary">{{ $attendee->document }}</p></div>
                </div>
                <hr>
                <div class="d-flex justify-content-around">
                    <a href="{{ url("attendee/$attendee->id/edit") }}" class="btn btn-primary rounded btn-sm mr-2"><i class="fa fa-pencil"></i> Editar</a>
                    <button type="button" class="btn btn-outline-danger rounded btn-sm" data-toggle="modal" data-target="#deleteModal" data-attendee_id="{{ $attendee->id }}">
                        <i class="fa fa-eraser" aria-hidden="true"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" attendee="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" attendee="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Esta seguro de eliminar este asistente?
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
@endsection
@section('script')
<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let recipient = button.data('attendee_id');
        let modal = $(this);
        modal.find('form').attr('action', 'attendee/' + recipient);
    });
</script>
@endsection
