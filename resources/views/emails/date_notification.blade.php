@extends('emails.layout')
@section('content')
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <h1>Hola</h1>

                @if ($notificationType == 'accepted')
                    <p>Has aceptado una cita con {{ $date->contact->full_name }}</p>
                    <p>{{ $date->mensage }}</p>
                @elseif ($notificationType == 'accepted_to')
                    <p>{{ $date->customer->full_name }} ha aceptando una cita contigo</p>
                    <p>{{ $date->mensage }}</p>
                    @elseif($notificationType == 'refuse_to')
                    <p>{{ $date->customer->full_name }} ha rechazado una cita contigo</p>

                @elseif($notificationType == 'refuse')
                    <p>Has rechazado una cita con {{ $date->contact->full_name }}</p>

                @endif
                <p><strong>Fecha: {{ $date->start_date->toDayDateTimeString() }}</strong></p>
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