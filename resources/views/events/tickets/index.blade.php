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
                                                    <button class="btn btn-sm btn-primary rounded"><i class="fa fa-pencil"></i> Editar</button>
                                                    <button class="btn btn-sm btn btn-outline-danger rounded"><i class="fa fa-eraser"></i> Borrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
                        <h5 class="modal-title">Nuevo Tiquete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['url' => url("events/$event->id/tickets"),'method' => 'POST', 'id' => 'form_ticket']) !!}
                        <input type="hidden" name="event_id" id="event_id" value="{{ $event->id }}">
                        <input type="hidden" name="created_by" id="created_by" value="{{ $event->created_by }}">
                        <input type="hidden" name="edited_by" id="edited_by" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="">Titulo</label>
                            <input class="form-control rounded" type="text" name="title">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="">Precio</label>
                                <input class="form-control rounded" type="text" name="price">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Cantidad disponible</label>
                                <input class="form-control rounded" type="text" name="quantity_available">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Descripción</label>
                            <input class="form-control rounded" type="text" name="description" >
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input_start">Inicio venta</label>
                                <div class="input-group date" id="input_start" data-target-input="nearest">
                                    <input type="text" class="form-control rounded-left datetimepicker-input" id="start_date" name="start_sale_date"  data-target="#input_start"/>
                                    <div class="input-group-append" data-target="#input_start" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input_start">Finalizar venta</label>
                                <div class="input-group date" id="input_end" data-target-input="nearest">
                                    <input type="text" class="form-control rounded-left datetimepicker-input" id="end_sale_date" name="end_sale_date"  data-target="#input_end" />
                                    <div class="input-group-append" data-target="#input_end" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="">Tiquete minimo por orden</label>
                                <input class="form-control rounded" type="number" name="min_per_person">
                            </div>
                            <div class="form-group col-6">
                                <label for="">Tiquete maximo por orden</label>
                                <input class="form-control rounded" type="number" name="max_per_person" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 form-group text-center">
                                <button  type="button" class="btn btn-light btn-sm border border-secondary rounded" onclick="toggleFormTicket()">Cancelar</button>
                            </div>
                            <div class="col-md-6 form-group text-center">
                                <button type="submit" class="btn btn-success btn-sm rounded">Guardar</button>
                            </div>
                        </div>
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
        function toggleFormTicket(){
            $('#newTicket').toggle();
            $('#content-form-ticket').toggle();
        }
    </script>
@endpush