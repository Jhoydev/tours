@extends('layouts.main')
@push('sidebar')
    @include('events.sidebar')
@endpush
@section('content')
<div class="row" id="tickets">
    <div class="col-12">
        <div class="row mt-5 d-flex align-items-center mb-3">
            <div class="col-md-auto">
                <h3 class="pb-0">Tickets - {{ $event->title }}</h3>
            </div>
            <div class="col text-right">
                <button class="btn btn-sm btn-success rounded" data-toggle="modal" data-target="#modal_create_ticket"><i class="fa fa-plus"></i> Nuevo Ticket</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            @if (count($event->tickets))
                                @foreach ($event->tickets as $ticket)
                                    <div class="col-md-auto">
                                        <div class="card border-info rounded">
                                            <div class="card-body text-center">
                                                <p class="h3 font-weight-bold">{{ $ticket->title }}</p>
                                                <p class="h1"><strong>{{ $ticket->price }}$</strong></p>
                                                <p>{{ $ticket->description }}</p>
                                                <div class="text-left">
                                                    <p>Inicio de venta: {{ $ticket->start_sale_date }}</p>
                                                    <p>Fin de venta: {{ $ticket->end_sale_date }}</p>
                                                    <p>Total de tiquetes a vender: {{ $ticket->quantity_available }}</p>
                                                    <p>Tiquete minimo por orden {{ $ticket->min_per_person }}</p>
                                                    <p>Tiquete maximo por orden {{ $ticket->max_per_person }}</p>
                                                </div>
                                                <p><small>Creado por: {{ $ticket->user->full_name }}</small></p>
                                                <div>
                                                    <button type="button" class="btn btn-sm btn-primary rounded" onclick="openModalEdit('{{ url("events/$event->id/tickets/$ticket->id/edit") }}')"><i class="fa fa-pencil"></i> Editar</button>
                                                    <button class="btn btn-sm btn btn-outline-danger rounded" data-toggle="modal" data-target="#deleteModal" data-ticket_id="{{ url("events/$event->id/tickets/$ticket->id") }}"><i class="fa fa-eraser"></i> Eliminar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="modal fade"  id="modal_edit_ticket" tabindex="-1" role="dialog" aria-labelledby="modal_edit_ticket" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Tiquete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::open(['url' => url("events/$event->id/tickets/$ticket->id"),'method' => 'PUT', 'id' => 'form_ticket_edit']) !!}
                                                @include('events.tickets.form')
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal_delete_ticket" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Tiquete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <i class="fa fa-warning text-warning"></i> Esta seguro de eliminar este tiquete
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary btn-sm rounded" data-dismiss="modal">Cancelar</button>
                                                {!! Form::open([ 'id' => 'form_delete' ,'url' => '','method' => 'DELETE','class' => 'd-inline-block']) !!}
                                                {!! Form::submit('Eliminar',['class' => 'btn btn-danger btn-sm rounded'])  !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 text-center">
                                    <p class="lead">Aun no has creado ningun tiquete</p>
                                    <button class="btn btn-sm btn-success rounded" data-toggle="modal" data-target="#modal_create_ticket"><i class="fa fa-plus"></i> Nuevo Ticket</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal fade"  id="modal_create_ticket" tabindex="-1" role="dialog" aria-labelledby="modal_create_ticket" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title h5">Nuevo Tiquete</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => url("events/$event->id/tickets"),'method' => 'POST', 'id' => 'form_ticket']) !!}
                        @include('events.tickets.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $('document').ready(()=>{

            $('#input_start').datetimepicker({
                format: "DD-MM-YYYY HH:mm:ss"
            });
            $('#input_end').datetimepicker({
                format: "DD-MM-YYYY HH:mm:ss"
            });

        });

        $('#deleteModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);// Button that triggered the modal
            let recipient = button.data('ticket_id'); // Extract info from data-* attributes
            let modal = $(this);
            modal.find('form').attr('action', recipient);
        });

        function openModalEdit(url){
            $("#modal_edit_ticket .modal-header > .modal-title ").append(`<span id="loading_modal_edit"><i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span><span>`);
            $("#modal_edit_ticket :input").prop("disabled", true);
            $('#modal_edit_ticket').modal('toggle');
            document.querySelector("#modal_edit_ticket form").reset();
            $.get(url,function (res) {
                document.querySelector("#modal_edit_ticket  #title").value = res.title;
                document.querySelector("#modal_edit_ticket  #price").value = res.price;
                document.querySelector("#modal_edit_ticket  #quantity_available").value = res.quantity_available;
                document.querySelector("#modal_edit_ticket  #description").value = res.description;
                document.querySelector("#modal_edit_ticket  #start_date").value = res.start_sale_date;
                document.querySelector("#modal_edit_ticket  #end_sale_date").value = res.end_sale_date;
                document.querySelector("#modal_edit_ticket  #min_per_person").value = res.min_per_person;
                document.querySelector("#modal_edit_ticket  #max_per_person").value = res.max_per_person;
                $("#loading_modal_edit").remove();
                $("#modal_edit_ticket :input").prop("disabled", false);
            })
        }
    </script>
@endpush