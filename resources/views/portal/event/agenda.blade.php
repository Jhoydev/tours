@extends('layouts.portal')
@push('sidebar')
@include('portal.event.sidebar')
@endpush
@section('content')
    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="card">
                <table class="table">
                    <thead class="thead-dark">
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
                        <td><button class="btn btn-light rounded border btn-sm" onclick="changeCustomerAgenda(this)" data-customer="{{ $customer->id }}" data-name="{{ $customer->full_name }}"><i class="fa fa-plus text-success" aria-hidden="true"></i></button></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" id="url-calendar" value="{{ url("api/portal/event/$event->id/customer/".Auth::user()->id."/calendar") }}">
                    <h3 id="agenda_name" class="text-center"></h3>
                    <div id='calendar'></div>
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
                    <input type="hidden" name="start_date">
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
<script>
    function startFullCalendar() {
        $("#calendar").fullCalendar({
            defaultView: 'agendaDay',
            slotDuration: '00:15:00',
            slotLabelInterval: '00:15:00',
            slotLabelFormat: 'h:mm a',
            timeFormat: 'h:mm a',
            minTime: '07:00',
            maxTime: '21:00',
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
                modal.find('input[name="start_date"]').val(date.format("YYYY-MM-DD HH:mm:ss"));
                modal.find('#span_date').html(date.format("DD-MM-YYYY HH:mm:ss"));
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
        url.val(url.val().replace(/customer\/\d\/calendar/,`customer/${customer}/calendar`));
        $("#calendar").fullCalendar('destroy');
        $("#agenda_name").html(name);
        $("#customer_id").val(customer);
        startFullCalendar();
    }
</script>
@endpush