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
                        <div class="col-12">
                            <button class="btn btn-block btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Descargar Memoria</button>
                            <button class="btn btn-block btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Descargar Certificado</button>
                        </div>
                        <div class="col-12">
                            Tiquetes {{ count($details) }} <a href="{{ url("portal/customer/event/$event->id/details") }}">Ver</a>
                        </div>
                        @if (count($orders))
                        <div class="col-12">
                            <a href="{{ url("portal/event/$event->id/orders") }}">Detalle de compra </a>
                        </div>
                        @endif
                        @if($details_null)
                        <div class="col-12">
                            Tiquetes sin asignar {{ $details_null }}
                        </div>
                        @endif
                    </div>
                    <hr>
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
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month'
            },
            events: {
                url: document.querySelector('#url-calendar').value,
            }
        });
    })
</script>
@endpush