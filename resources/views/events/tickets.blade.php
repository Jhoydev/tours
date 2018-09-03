@extends('layouts.main')
@push('sidebar')
    @include('events.sidebar')
@endpush
@section('content')
<div class="row" id="tickets">
    <div class="col-12">
        <div class="row mt-5">
            <div class="col-md-12">
                <h3>Tickets - {{ $event->title }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 text-center" id="newTicket">
                <div class="card" style="cursor: pointer;" onclick="toggleFormTicket()">
                    <div class="card-body">
                        <h2><i class="fa fa-plus" aria-hidden="true"></i></h2>
                        <p>Nuevo ticket</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6" id="content-form-ticket" style="display: none">
                <div class="card">
                    <div class="card-body">
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
        <div class="row">
            @foreach ($event->tickets as $ticket)
                <div class="col-md-auto">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5>{{ $ticket->title }}</h5>
                            <p>{{ $ticket->price }}</p>
                            <p>{{ $ticket->description }}</p>
                            <p>{{ $ticket->start_sale_date }} - {{ $ticket->end_sale_date }}</p>
                            <p><small> {{ $ticket->user->full_name }}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
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