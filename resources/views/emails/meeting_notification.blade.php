@extends('emails.layout')
@section('content')
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <h1>Hola</h1>

                @if ($notificationType == 'accepted')
                    <p>Cita aceptada entre {{ $meeting->customer->full_name }} y {{ $meeting->contact->full_name }}</p>
                @elseif($notificationType == 'refuse')
                    <p>Se ha cancelado la cita rechazado entre {{ $meeting->customer->full_name }} y {{ $meeting->contact->full_name }}</p>
                @endif
                <p><strong>Fecha: {{ $meeting->start_date->toDayDateTimeString() }}</strong></p>
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