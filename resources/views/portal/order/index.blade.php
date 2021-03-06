@extends('layouts.portal')
@section('content')
    @push('sidebar')
    @include('portal.event.sidebar')
    @endpush
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <p class="display-5 text-center">{{ $event->title }}</p>
                    <p class="display-3 font-weight-bold text-center"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Ordenes</p>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="table_datatable" class="table">
                                    <thead class="bg-primary text-white">
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Valor</th>
                                        <th class="text-center">Estado</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td class="text-right">${{ number_format($order->value,2) }}</td>
                                            <td class="text-center"><span class="badge badge-success badge-pill p-1">{{ $order->order_status->name }}</span></td>
                                            <td class="text-right">
                                                <a href="{{ route('customer.event.order',['event' => $event->id,'order' => $order->id]) }}" class="btn btn-sm btn-success rounded">
                                                    <i class="fa fa-file"></i>
                                                    Revisar
                                                    @if ($order->pending_assign)
                                                        <span class="badge badge-danger badge-pill"  data-toggle="tooltip" data-placement="top" title="Tiquetes sin asignar">{{$order->pending_assign}}</span>
                                                    @endif
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('layouts.js.datatable')
@endpush