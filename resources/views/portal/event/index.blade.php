@extends('layouts.portal')
@push('sidebar')
@include('portal.event.sidebar')
@endpush
@section('content')
    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center"><i class="icon-calendar"></i> {{ $event->title }}</h1>
                    <hr>
                    <div class="row">
                        <div class="col-auto mb-2">
                            <button class="btn btn-primary rounded"><i class="fa fa-download" aria-hidden="true"></i> Descargar Memoria</button>
                            <button class="btn btn-primary rounded"><i class="fa fa-download" aria-hidden="true"></i> Descargar Certificado</button>
                        </div>
                        <div class="col-auto mb-2">
                            <a class="btn btn-primary rounded" href="{{ url("portal/customer/event/$event->id/details") }}">
                                Tiquetes
                                <span class="badge badge-light"  data-toggle="tooltip" data-placement="top" title="Tus tiquetes">
                                    {{ count($details) }}
                                </span>
                            </a>
                        </div>
                        @if (count($orders))
                        <div class="col-auto mb-2">
                            <a class="btn btn-success rounded" href="{{ url("portal/event/$event->id/orders") }}">
                                Detalle de compra
                                @if($details_null)
                                    <span class="badge badge-danger"  data-toggle="tooltip" data-placement="top" title="Tiquetes sin asignar">
                                        {{ $details_null }}
                                    </span>
                                @endif
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" id="url-calendar" value="{{ url('api/calendar/customer/'.Auth::user()->id) }}">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            }
        });
    })
</script>
@endpush