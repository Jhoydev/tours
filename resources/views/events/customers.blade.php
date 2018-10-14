@extends('layouts.main')
@section('content')
@include('layouts.menssage_success')
@push('sidebar')
    @include('events.sidebar')
@endpush
<div class="row mt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="h1 text-center">Asistentes</p>
                <hr>
                <div class="table-responsive">
                    <input type="hidden" id="url_attended" value="{{ url("api/event/$event->id/order-detail") }}">
                    <table id="table_datatable" class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>Nº Tiquete</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Empresa</th>
                            <th class="text-center">Asistió</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($details as $detail)
                            <tr>
                                <td>{{ $detail->id }}</td>
                                <td>{{ ($detail->customer) ? $detail->customer->full_name : 'sin asignar' }}</td>
                                <td>{{ ($detail->customer) ? $detail->customer->documento : 'sin asignar' }}</td>
                                <td>{{ ($detail->customer) ? $detail->customer->workplace : 'sin asignar' }}</td>
                                @if ($detail->attended)
                                    <td class="text-center"><i class="fa fa-check text-success" aria-hidden="true"></i></td>
                                @else
                                    <td class="td-attended text-center"><button onclick="orderDetailAttended({{ $detail->id }})" class="btn btn-success border rounded btn-sm" data-toggle="tooltip" data-placement="top" title="Marcar asistencia"><i class="fa fa-check" aria-hidden="true"></i></button></td>
                                @endif
                                <td class="text-right">
                                    <div class="dropdown open">
                                        <button class="btn btn-light border rounded btn-sm dropdown-toggle" type="button" id="triggerId"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="triggerId">
                                            <button class="dropdown-item" href="#">Action</button>
                                            <button class="dropdown-item" href="#">Action</button>
                                            <button class="dropdown-item" href="#">Action</button>
                                        </div>
                                    </div>
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
@endsection
@push('scripts')
    @include('layouts.js.datatable')
    <script>
        function orderDetailAttended(order_detail) {
            let url = $("#url_attended").val();
            url = url + "/" + order_detail + "/attended";
            let tr = $(this.event.target).closest('tr');
            let data = {
              '_token' : $('input[name="csrf-token"]').val()
            };
            $.post(url,data).done(function (res){
                if (res.status){
                    $(tr).find('.td-attended').html(`<i class="fa fa-check text-success" aria-hidden="true"></i>`);
                    alert
                }
            });
        }
    </script>
@endpush