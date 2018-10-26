@extends('layouts.template.melody')
@push('sidebar')
    @include('events.sidebar')
@endpush
@section('content')
<div class="row">
    <div class="col-12 text-right">
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal_ticket" data-url_post="{{ url("events/$event->id/tickets") }}"><i class="fa fa-plus"></i> Nuevo Ticket</button>
    </div>
</div>
<div class="row" id="tickets">
    <div class="col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card rounded">
                    <div class="card-body">
                        <p class="display-5  text-center">{{ $event->title }}</p>
                        <p class="display-3 font-weight-bold text-center"><i class="fa fa-ticket-alt" aria-hidden="true"></i> Tiquetes</p>
                        <hr>
                        <div class="row justify-content-center">
                            @if (count($event->tickets))
                                @foreach ($event->tickets as $ticket)
                                    <div class="col-md-auto">
                                        <div class="card border-info rounded">
                                            <div class="card-body text-center">
                                                <p><span class="badge badge-info text-white">{{ $ticket->type }}</span></p>
                                                <p class="h3 font-weight-bold">{{ $ticket->title }}</p>
                                                <p class="h1"><strong>${{ $ticket->price }}</strong></p>
                                                <p>{{ $ticket->description }}</p>
                                                <div class="text-left">
                                                    <p>Inicio de venta: {{ $ticket->start_sale_date->format('d-m-Y H:i:s') }}</p>
                                                    <p>Fin de venta: {{ $ticket->end_sale_date->format('d-m-Y H:i:s') }}</p>
                                                    <p>Total de tiquetes a vender: {{ $ticket->quantity_available }}</p>
                                                    <p>Tiquete minimo por orden {{ $ticket->min_per_person }}</p>
                                                    <p>Tiquete maximo por orden {{ $ticket->max_per_person }}</p>
                                                </div>
                                                <p><small>Creado por: {{ $ticket->user->full_name ?? '' }}</small></p>
                                                <div>
                                                    @if ($ticket->type != 'simple')
                                                    <a class="btn btn-success btn-sm rounded" href="{{ url("events/$event->id/tickets/$ticket->id/send-tickets") }}"><i class="fa fa-plus" aria-hidden="true"></i> Enviar Tiquete</a>
                                                    @endif
                                                    <button type="button" class="btn btn-sm btn-primary rounded" data-toggle="modal" data-target="#modal_ticket" data-url="{{ url("events/$event->id/tickets/$ticket->id/edit") }}"><i class="fa fa-pencil-alt"></i> Editar</button>
                                                    <button class="btn btn-sm btn btn-outline-danger rounded" data-toggle="modal" data-target="#deleteModal" data-ticket_id="{{ url("events/$event->id/tickets/$ticket->id") }}"><i class="fa fa-eraser"></i> Eliminar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modal_delete_ticket" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Tiquete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <i class="fa fa-warning text-warning"></i> Esta seguro de eliminar este tiquete
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
                                                {!! Form::open([ 'id' => 'form_delete' ,'url' => '','method' => 'DELETE','class' => 'd-inline-block']) !!}
                                                {!! Form::submit('Eliminar',['class' => 'btn btn-danger btn-sm'])  !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 text-center">
                                    <p class="lead">Aun no has creado ningun tiquete</p>
                                    <button class="btn btn-success rounded mr-5" data-toggle="modal" data-target="#modal_ticket" data-url_post="{{ url("events/$event->id/tickets") }}"><i class="fa fa-plus"></i> Nuevo Ticket</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal fade"  id="modal_ticket" tabindex="-1" role="dialog" aria-labelledby="modal_ticket" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <span class="modal-title h5"><i class="fa fa-ticket-alt" aria-hidden="true"></i> Nuevo Tiquete</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => url("events/$event->id/tickets"),'method' => 'POST', 'id' => 'form_ticket']) !!}
                        @include('events.tickets.form',['action' => 'create'])
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
                useCurrent: false,
                format: "DD-MM-YYYY HH:mm:ss"
            });
            $("#input_start").on("change.datetimepicker", function (e) {
                $('#input_end').datetimepicker('minDate', e.date);
            });
            $("#input_end").on("change.datetimepicker", function (e) {
                $('#input_start').datetimepicker('maxDate', e.date);
            });


        });

        $('#deleteModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);// Button that triggered the modal
            let recipient = button.data('ticket_id'); // Extract info from data-* attributes
            let modal = $(this);
            modal.find('form').attr('action', recipient);
        });

        $('#modal_ticket').on('show.bs.modal', function (event) {
            let modal = $(this);
            let form = modal.find('form');
            let button = $(event.relatedTarget);// Button that triggered the modal
            if (button.data('url')){
                openModalEdit(button.data('url'));
            }
            if (button.data('url_post')){
                form.attr('action',button.data('url_post'));
            }
            let recipient = button.data('ticket_id'); // Extract info from data-* attributes
            form[0].reset();
            form.find('input[name="_method"]').remove();
        });

        function openModalEdit(url){
            $("#modal_ticket .modal-header > .modal-title ").append(`<span id="loading_modal_edit"><i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span><span>`);
            $("#modal_ticket :input").prop("disabled", true);
            $('#modal_ticket').modal('toggle');
            document.querySelector("#modal_ticket form").reset();
            $.get(url,function (res) {
                let $form = $(document.querySelector("#modal_ticket form"));
                let action = url.replace('/edit','');
                $form.append(`<input name="_method" type="hidden" value="PUT">`);
                document.querySelector("#modal_ticket  #title").value = res.title;
                document.querySelector("#modal_ticket  #price").value = res.price;
                document.querySelector("#modal_ticket  #quantity_available").value = res.quantity_available;
                document.querySelector("#modal_ticket  #description").value = res.description;
                document.querySelector("#modal_ticket  #start_date").value = moment(res.start_sale_date).format("DD-MM-YYYY HH:mm:ss");
                document.querySelector("#modal_ticket  #end_date").value = moment(res.end_sale_date).format("DD-MM-YYYY HH:mm:ss");
                document.querySelector("#modal_ticket  #min_per_person").value = res.min_per_person;
                document.querySelector("#modal_ticket  #max_per_person").value = res.max_per_person;
                document.querySelector("#modal_ticket  #type").value = res.type;
                $form.attr('action',action);
                $("#loading_modal_edit").remove();
                $("#modal_ticket :input").prop("disabled", false);
            })
        }
    </script>
@endpush