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
                                <td>{{ $detail->price }}</td>
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