@extends('layouts.template.melody')
@section('content')
    @include('layouts.menssage_success')
    @push('sidebar')
        @include('admin.events.sidebar')
    @endpush
    <div class="row">
        <div class="col-12">
            <div class="card rounded">
                <div class="card-body">
                    <p class="display-5 text-center">{{ $event->title }}</p>
                    <p class="display-3 font-weight-bold text-center"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Detalles de Orden</p>
                    <hr>
                    <table id="table_datatable" class="table fade table-hover">
                    <thead class="bg-primary text-white">
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