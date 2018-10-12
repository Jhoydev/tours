@extends('layouts.main')
@section('content')
    @include('layouts.menssage_success')
    @push('navbar_items_right')
    <li class="nav-item">
        <a class="btn btn-success rounded mr-5" href="{{ url('customer/create') }}"><i class="fa fa-plus"></i> Nuevo Asistente</a>
    </li>
    @endpush
    <div class="row mt-2">
        <div class="col-12" id="render_customers">
            <div class="card">
                <div class="card-body">
                    <p class="h1">Asignar Tiquete - {{ $ticket->type }}</p>
                    <p>Disponibles: {{ $ticket->quantity_available }}</p>
                    <table id="table_datatable" class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo Electrónico</th>
                            <th>Teléfono</th>
                            <th>Celular</th>
                            <th class="text-center">Enviadas</th>
                            <th>Accion</th>
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
                                <td class="text-center">{{ count($customer->orderDetailsSpecial($ticket->type)) }}</td>
                                <td class="text-right">
                                    <button type="button" class="btn btn-outline-primary btn-sm mb-2 rounded"
                                            data-toggle="modal" data-target="#assignModal"
                                            data-customer_id="{{ $customer->id }}"
                                            data-url="{{ url("events/$event->id/tickets/$ticket->id/assign-ticket") }}"
                                    >
                                        <i class="fa fa-plus" aria-hidden="true"></i> Asignar
                                    </button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Aviso</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {!! Form::open([ 'id' => 'form_delete' ,'url' => '','method' => 'POST']) !!}
                            <div class="form-group">
                                <select class="form-control" name="quantity_available">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                                <input type="hidden" id="customer_id" name="customer_id">
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-secondary btn-sm rounded mr-3" data-dismiss="modal">Cancelar</button>
                                {!! Form::submit('Enviar',['class' => 'btn btn-outline-success btn-sm rounded'])  !!}
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