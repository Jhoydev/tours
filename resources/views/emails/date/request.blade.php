@extends('emails.layout')
@section('content')
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <h1>Hola</h1>
                <p>Solicitud de cita</p>
                <p>{{ $date->customer->full_name }} - {{ $date->contact->full_name }}</p>
                <p><strong>Fecha: {{ $date->start_date->toDayDateTimeString() }}</strong></p>
                <p>Mensaje: {{ $date->message }}</p>
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
                Evento organizado por {{ $date->event->company->name }}<br>
                Fecha del evento {{ $date->event->start_date->toDayDateTimeString() }}<br>
                Lugar {{ $date->event->address }}
            </td>
        </tr>
    </table>
@endsection