@extends('layouts.template.melody')
@section('content')
    @include('layouts.menssage_success')
    @push('sidebar')
    @include('events.sidebar')
    @endpush
    <div class="row">
        <div class="col-12" id="render_customers">
            <div class="card">
                <div class="card-body">
                    <p class="display-5 text-center">{{ $event->title }}</p>
                    <p class="display-3 font-weight-bold text-center"><i class="fa fa-ticket-alt" aria-hidden="true"></i> Tiquete - {{ $ticket->title }}</p>
                    <hr>
                    <p class="display-5">Disponibles: <span class="badge badge-info badge-pill">{{ $ticket->quantity_available }}</span></p>
                    <table id="table_datatable" class="table fade table-hover">
                        <thead class="bg-primary text-white">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo Electrónico</th>
                            <th>Teléfono</th>
                            <th>Celular</th>
                            <th class="text-center">Enviadas</th>
                            <th class="text-center">Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td scope="row">{{ $customer->id }}</td>
                                <td scope="row">{{ ucfirst($customer->first_name) }} {{ ucfirst($customer->last_name) }}</td>
                                <td scope="row">{{ $customer->email }}</td>
                                <td scope="row">{{ $customer->mobile }}</td>
                                <td scope="row">{{ $customer->phone }}</td>
                                <td class="text-center">{{ count($customer->orderDetailsSpecial($ticket->id)) }}</td>
                                <td class="text-right">
                                    @if(count($customer->orderDetailsSpecial($ticket->id)))
                                        <a href="{{ url("events/$ticket->event_id/tickets/$ticket->id/send-tickets/customer/$customer->id") }}" class="btn btn-success btn-sm mb-2 rounded"><i class="fa fa-sign-in" aria-hidden="true"></i> Ver</a>
                                    @endif
                                    @if ($ticket->quantity_available)
                                    <button type="button" class="btn btn-outline-primary btn-sm mb-2 rounded"
                                            data-toggle="modal" data-target="#assignModal"
                                            data-customer_id="{{ $customer->id }}"
                                            data-url="{{ url("events/$event->id/tickets/$ticket->id/send-tickets") }}"
                                    >
                                        <i class="fa fa-plus" aria-hidden="true"></i> Asignar
                                    </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="assignModal" tabindex="-1" customer="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" customer="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Asigar Tiquete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open([ 'id' => 'form_delete' ,'url' => '','method' => 'POST']) !!}
                            <div class="form-group">
                                <label for="label-quantity_available">Cantidad</label>
                                <input class="form-control" type="number" id="label-quantity_availabl" name="quantity_available"
                                       min="{{ $ticket->min_per_person }}"
                                       max="{{ ($ticket->quantity_available > $ticket->max_per_person) ?  $ticket->max_per_person : $ticket->quantity_available }}"
                                       required>
                            </div>
                            <input type="hidden" id="customer_id" name="customer_id">
                            <div class="form-group d-flex justify-content-end">
                                <button type="button" class="btn btn-light btn-sm mr-3" data-dismiss="modal">Cancelar</button>
                                {!! Form::submit('Enviar',['class' => 'btn btn-primary btn-sm rounded'])  !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            @push('scripts')
            @include('layouts.js.datatable')
            <script>
                $('#assignModal').on('show.bs.modal', function (event) {
                    let button = $(event.relatedTarget);
                    let url= button.data('url');
                    let customer_id= button.data('customer_id');
                    let modal = $(this);
                    modal.find('form').attr('action',url);
                    modal.find('#customer_id').val(customer_id);
                });
            </script>
            @endpush
        </div>
    </div>
@endsection