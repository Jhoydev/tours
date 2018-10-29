@extends('emails.layout')
@section('content')
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <h1>Hola</h1>
                <p>Solicitud de cita</p>
                <p>{{ $meeting->customer->full_name }} - {{ $meeting->contact->full_name }}</p>
                <p><strong>Fecha: {{ $meeting->start_date->toDayDateTimeString() }}</strong></p>
                <p>Mensaje: {{ $meeting->message }}</p>
                <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                    <tbody>
                    <tr>
                        <td align="left">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                <tr>
                                    <td> <a href="{{ url('portal') }}" target="_blank">Acceder a {{ config('app.name', 'Laravel') }}</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br>
                Evento organizado por {{ $meeting->event->company->name }}<br>
                Fecha del evento {{ $meeting->event->start_date->toDayDateTimeString() }}<br>
                Lugar {{ $meeting->event->address }}
            </td>
        </tr>
    </table>
@endsection