@extends('layouts.portal')
@push('sidebar')
@include('portal.event.sidebar')
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" id="auth_customer_id" value="{{ Auth::user()->id }}">
                    <h1 class="text-center"><i class="icon-calendar"></i> {{ $event->title }}</h1>
                    <h4 class="text-center">{{ $event->address }}</h4>
                    <h3 class="text-center">{{ $event->start_date->toDayDateTimeString() }}</h3>
                    @if($event->flyer)
                    <div class="row justify-content-center">
                        <div class="col-lg-2">
                            <img src="{{ url($event->flyer) }}" class="img-fluid" style="min-width: 100%; min-height:150px"  alt="">

                        </div>
                    </div>
                    @endif
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-auto mb-2">
                            @if($event->memories_url)
                            <a href="{{ $event->memories_url }}" target="_blank" class="btn btn-light border rounded"><i class="fa fa-download" aria-hidden="true"></i> Descargar Memoria</a>
                            @endif
                            {{--<button class="btn btn-light border rounded"><i class="fa fa-download" aria-hidden="true"></i> Descargar Certificado</button>--}}
                        </div>
                        <div class="col-auto mb-2">
                            <a class="btn btn-primary rounded" href="{{ url("portal/customer/event/$event->id/details") }}">
                                Tiquetes
                                <span class="badge badge-light"  data-toggle="tooltip" data-placement="top" title="Tus tiquetes">
                                    {{ count($details) }}
                                </span>
                            </a>
                            @if (count($orders))
                                <a class="btn btn-success rounded" href="{{ url("portal/event/$event->id/orders") }}">
                                    Detalle de compra
                                    @if($details_null)
                                        <span class="badge badge-danger"  data-toggle="tooltip" data-placement="top" title="Tiquetes sin asignar">
                                        {{ $details_null }}
                                        </span>
                                    @endif
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($event->event_type_id == 2)
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-center">Agenda</h2>
                            <hr>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="mr-3"><i class="fa fa-circle text-success" aria-hidden="true"></i> Aceptadas</span>
                            <span class="mr-3"><i class="fa fa-circle text-warning" aria-hidden="true"></i> Pendiente</span>
                        </div>
                        <div class="col-12">
                            <input type="hidden" id="url-calendar" value="{{ url("api/portal/event/$event->id/customer/".Auth::user()->id."/calendar") }}">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_event" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    {!! Form::open(['url' => '','method' => 'PUT','id'=>'btn-date-put','class' => 'd-none']) !!}
                        <button type="submit" class="btn btn-success rounded">Aceptar</button>
                    {!! Form::close() !!}
                    {!! Form::open(['url' => '','method' => 'DELETE','id' => 'btn-date-delete','class' => 'd-none']) !!}
                    <button type="submit" class="btn btn-danger rounded">Cancelar</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $("#calendar").fullCalendar({
            defaultView: 'listWeek',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            events: {
                url: document.querySelector('#url-calendar').value,
            },
            eventClick: function(calEvent, jsEvent, view) {
                let modal = $('#modal_event');
                let text = "";
                let form_put = document.querySelector('#btn-date-put');
                let form_delete = document.querySelector('#btn-date-delete');
                form_put.classList.add('d-none');
                form_delete.classList.add('d-none');
                modal.find('.modal-title').html('Cita');
                text = `
                    <ul class="list-unstyled">
                        <li>Empresa: ${calEvent.contact.workplace}</li>
                        <li>Nombre: ${calEvent.contact.first_name} ${calEvent.contact.last_name}</li>
                        <li>Profesión: ${calEvent.contact.profession}</li>
                        <li>Correo Electrónico: ${calEvent.contact.email}</li>
                        <li>Celular: ${calEvent.contact.mobile}</li>
                    </ul>
                `;
                modal.find('.modal-body').html(text);

                if (calEvent.status === 1){
                    form_delete.action = calEvent.req;
                    form_delete.classList.remove('d-none');
                }
                if (calEvent.status === 2){
                    form_put.action = calEvent.req;
                    form_delete.action = calEvent.req;
                    form_put.classList.remove('d-none');
                    form_delete.classList.remove('d-none');
                }
                if ($('#auth_customer_id').val() == calEvent.contact_id){
                    form_put.classList.add('d-none');
                }
                modal.modal('toggle')

            }
        });
    })
</script>
@endpush