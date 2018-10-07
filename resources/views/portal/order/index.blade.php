@extends('layouts.portal')
@section('content')
    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center"><i class="icon-calendar"></i> {{ $event->title }}</h1>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="table_datatable" class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Reference</th>
                                        <th class="text-center">Valor</th>
                                        <th class="text-center">Estado</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->reference }}</td>
                                            <td class="text-right">${{ number_format($order->value,2) }}</td>
                                            <td class="text-center"><span class="badge badge-success p-1">{{ $order->order_status->name }}</span></td>
                                            <td class="text-right">
                                                <a href="{{ route('customer.event.order',['event' => $event->id,'order' => $order->id]) }}" class="btn btn-sm btn-success rounded"><i class="fa fa-file"></i> Revisar {{ $details_null }}</a>
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