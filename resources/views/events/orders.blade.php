@extends('layouts.main')
@section('content')
    @include('layouts.menssage_success')
    @include('errors.validation')
    @push('sidebar')
        @include('events.sidebar')
    @endpush
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="h4 text-center">{{ $event->title }}</p>
                    <p class="h1 text-center"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Ordenes</p>
                    <hr>
                    @if(count($tickets))
                    <div class="row mb-2">
                        <div class="col-lg-12 text-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-primary rounded" data-toggle="modal"
                                    data-target="#modelImportar">
                                <i class="fa fa-download" aria-hidden="true"></i> Importar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade text-left" id="modelImportar" tabindex="-1" role="dialog"
                                 aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            @include('events.import_form')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <input type="hidden" id="url_order_confirm" value="{{ url("api/event/$event->id/order") }}">
                    <table id="table_datatable" class="table fade">
                        <thead class="thead-dark">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo Electrónico</th>
                            <th>Valor</th>
                            <th>Medio de Pago</th>
                            <th class="text-center">Estado</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($event->orders as $order)
                            <tr class="text-center">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer->full_name }}</td>
                                <td>{{ $order->customer->email }}</td>
                                <td class="text-right">${{ number_format($order->price,2) }}</td>
                                <td class="text-center"><span class="badge badge-info text-white">{{ ($order->transaction_id) ? 'online' : 'En efectivo' }}</span></td>
                                <td class="text-center td-status">
                                    @if($order->order_status_id == 2)
                                    <button class="btn btn-warning text-white btn-sm rounded" onclick="confirmOrder({{ $order->id }})">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        {{ $order->order_status->name }}</button>
                                    @else
                                    <span class="badge badge-success">{{ $order->order_status->name }}</span>
                                    @endif
                                </td>
                                <td class="text-right"><a class="btn btn-sm btn-success rounded" href="{{ route('event.orders.details',['event' => $event->id,'order' => $order->id]) }}"><i class="fa fa-sign-in" aria-hidden="true"></i> ver</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('layouts.js.datatable')
<script>
    function confirmOrder(order){
        let tr = $(this.event.target).closest('tr');
        let url = $("#url_order_confirm").val();
        url = url + "/" + order + "/confirm";
        let data = {
            '_token' : $('input[name="csrf-token"]').val(),
            '_method' : 'PUT'
        };
        $.post(url,data).done(function (res){
            if (res.status){
                $(tr).find('.td-status').html(`<span class="badge badge-success">pago</span>`);
                alert('Orden Confirmada');
            }
        });
    }
</script>
@endpush