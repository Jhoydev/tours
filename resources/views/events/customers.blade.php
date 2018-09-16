@extends('layouts.main')
@section('content')
@include('layouts.menssage_success')
@push('sidebar')
    @include('events.sidebar')
@endpush
<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Correo Electronico</th>
                        <th>Telefono</th>
                        <th>Celular</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($event->customers as $customer)
                        <tr>
                            <td scope="row">{{ $customer->full_name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->mobile }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection