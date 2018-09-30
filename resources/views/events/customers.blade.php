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
                <p class="h1">Asistentes</p>
                <table id="table_datatable" class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Teléfono</th>
                        <th>Celular</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attendees as $attendee)
                        @if($attendee->customer)
                            <tr>
                                <td scope="row">{{ $attendee->customer->full_name }}</td>
                                <td scope="row">{{ $attendee->customer->email }}</td>
                                <td scope="row">{{ $attendee->customer->mobile }}</td>
                                <td scope="row">{{ $attendee->customer->phone }}</td>
                            </tr>
                        @endif
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
@endpush