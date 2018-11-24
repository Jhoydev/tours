@extends('layouts.template.melody')
@section('content')
    @include('layouts.menssage_success')
    @include('errors.validation')
    @push('sidebar')
        @include('events.sidebar')
    @endpush
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="display-5 text-center">{{ $event->title }}</p>
                    <p class="display-3 font-weight-bold text-center"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Ordenes</p>
                    <hr>
                    @if(count($tickets))
                    <div class="row mb-2">
                        <div class="col-lg-12 text-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-info rounded" data-toggle="modal"
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
                    <table id="table_datatable" class="table fade table-hover">
                        <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo Electrónico</th>
                            <th>Valor</th>
                            <th>Medio de Pago</th>
                            <th class="text-center">Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($event->orders as $order)
                            <tr class="text-center">
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer->full_name }}</td>
                                <td>{{ $order->customer->email }}</td>
                                <td class="text-right">${{ number_format($order->price,2) }}</td>
                                <td class="text-center"><span class="text-info font-weight-bold">{{ ($order->transaction_id) ? 'En Linea' : 'Efectivo' }}</span></td>
                                <td class="text-center td-status">
                                    <span class="{{ $order->statusColor() }} font-weight-bold">{{ $order->order_status->name }}</span>
                                </td>
                                <td class="text-right">
                                    @if(trim($order->payu_order_id) != "")
                                        @if($order->order_status_id == "1")
                                            <a class="text-success" href="#" onclick="confirmOrder('{{ route("order.confirm", [$event->id, $order]) }}')"><i class="fa fa-check-double" aria-hidden="true"></i> Reembolsar Orden</a>
                                        @elseif($order->order_status_id == "2")
                                            <a class="text-success" href="#" onclick="confirmOrder('{{ route("order.confirm", [$event->id, $order]) }}')"><i class="fa fa-check-double" aria-hidden="true"></i> Verificar Orden</a>
                                            <a class="text-success" href="#" onclick="confirmOrder('{{ route("order.confirm", [$event->id, $order]) }}')"><i class="fa fa-check-double" aria-hidden="true"></i> Cancelar Orden</a>
                                        @endif
                                    @elseif(trim($order->payu_order_id) == "")
                                        @if($order->order_status_id == "1")
                                            <a class="text-success" href="#" onclick="confirmOrder('{{ route("order.confirm", [$event->id, $order]) }}')"><i class="fa fa-check-double" aria-hidden="true"></i> Reembolsar Orden</a>
                                        @elseif($order->order_status_id == "2")
                                            <a class="text-success" href="#" onclick="confirmOrder('{{ route("order.confirm", [$event->id, $order]) }}')"><i class="fa fa-check-double" aria-hidden="true"></i> Confirmar Orden</a>
                                            <a class="text-success" href="#" onclick="confirmOrder('{{ route("order.confirm", [$event->id, $order]) }}')"><i class="fa fa-check-double" aria-hidden="true"></i> Cancelar Orden</a>
                                        @endif
                                    @endif
                                    <a class="" href="{{ route('event.orders.details',['event' => $event->id,'order' => $order->id]) }}"><i class="fa fa-sign-in-alt" aria-hidden="true"></i> Detalles</a>
                                </td>
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
    function confirmOrder(url){
        axios.put(url)
        .then(function (response) {
            if (res.status){
                showAlertSuccess('Pago confirmado');
            }
        }).catch(function (error) {
            console.log(error);
        });
    }
</script>
@endpush
