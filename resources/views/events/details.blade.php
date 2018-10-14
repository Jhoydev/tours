@extends('layouts.main')
@section('content')
    @include('layouts.menssage_success')
    @push('sidebar')
        @include('events.sidebar')
    @endpush
    <div class="row mt-5">
        <div class="col-12">
            <div class="card rounded">
                <div class="card-body">
                    <p class="h4 text-center">{{ $event->title }}</p>
                    <p class="h1 text-center"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Detalles de Orden</p>
                    <hr>
                    <div class="row">
                        <div class="col-12 text-right mb-3">
                            {!! Form::open(['url' => url("order/$order->id"),'method' => 'DELETE','id' => 'form-order-cancel']) !!}
                            <button class="btn btn-outline-danger btn-sm rounded"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar orden</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <table id="table_datatable" class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Tiquete</th>
                            <th>Precio</th>
                            <th>Para</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $detail)
                            <tr>
                                <td scope="row">{{ $detail->id }}</td>
                                <td>{{ $detail->ticket->title }}</td>
                                <td>${{ number_format($detail->price,2) }}</td>
                                @if ($detail->customer)
                                    <td>{{ $detail->customer->full_name }}</td>
                                @else
                                    <td>Sin asignar</td>
                                @endif
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
    $("#form-order-cancel").submit(function (ev) {
        if (!confirm('Todos los tiquetes relacionados con esta orden serán puestos a la venta de nuevo. \n ¿Esta seguro de cancelar esta order?')){
            ev.preventDefault();
            return false;
        }
    })
</script>
@endpush