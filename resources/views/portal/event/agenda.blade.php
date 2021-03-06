@extends('layouts.portal')
@push('sidebar')
@include('portal.event.sidebar')
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <table id="table_datatable" class="table fade table-hover">
                        <thead class="bg-primary text-white">
                        <tr>
                            <th>Nombre</th>
                            <th>Empresa</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            @continue($customer->id == Auth::user()->id)
                            <tr>
                                <td>{{ $customer->full_name }}</td>
                                <td>{{ $customer->workplace }}</td>
                                <td class="text-right"><button class="btn btn-light rounded border btn-sm" onclick="changeCustomerAgenda(this)" data-customer="{{ $customer->id }}" data-name="{{ $customer->full_name }}"><i class="fa fa-sign-in-alt text-success" aria-hidden="true"></i></button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" id="url-calendar" value="{{ url("portal/event/$event->id/agenda/customer/".Auth::user()->id."/calendar") }}">
                    <h3 id="agenda_name" class="text-center"></h3>
                    <div id='calendar' class="full-calendar"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade"  id="modal_add_date" tabindex="-1" role="dialog" aria-labelledby="modal_add_date" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title h5">Pedir Cita</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url' => url("portal/event/$event->id/date"),'method' => 'POST']) !!}
                    <input type="hidden" value="{{ Auth::user()->id }}" name="contact_id">
                    <input type="hidden" name="customer_id" id="customer_id">
                    <input type="hidden" name="start_meeting">
                    <p>Cita <span id="span_date"></span></p>
                    <div class="form-group">
                        <label for="message">Mensaje <small>(opcional)</small></label>
                        <textarea class="form-control" name="message" id="message" cols="30" rows="5"></textarea>
                    </div>
                    <button class="btn btn-success btn-block rounded"><i class="fa fa-send" aria-hidden="true"></i> Pedir Cita</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@include('layouts.js.datatable')
<script>
    function startFullCalendar() {
        $("#calendar").fullCalendar({
            defaultView: 'agendaDay',
            slotDuration: '00:15:00',
            locale: 'es',
            slotLabelInterval: '00:15:00',
            slotLabelFormat: 'h:mm a',
            timeFormat: 'h:mm a',
            height:1000,
            /*minTime: '07:00',
            maxTime: '21:00',*/
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            events: {
                url: document.querySelector('#url-calendar').value,
            },
            dayClick: function (date,jsEvent,view, resourceObj){
                let modal = $("#modal_add_date");
                modal.modal('toggle');
                modal.find('input[name="start_meeting"]').val(date.format("YYYY-MM-DD HH:mm:ss"));
                modal.find('#span_date').html(date.format("dddd, DD MMMM YYYY - HH:mm:ss"));
            },
            eventClick: function(calEvent, jsEvent, view) {
                console.log(calEvent);
            }
        });
    }
    function changeCustomerAgenda(el){
        let customer = $(el).data('customer');
        let name = $(el).data('name');
        let url = $("#url-calendar");
        url.val(url.val().replace(/customer\/\d*\/calendar/,`customer/${customer}/calendar`));
        $("#calendar").fullCalendar('destroy');
        $("#agenda_name").html(name);
        $("#customer_id").val(customer);
        startFullCalendar();
    }
</script>
@endpush