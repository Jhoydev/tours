@extends('emails.layout')
@section('content')
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <h1>Hola</h1>
                @if($orderDetail->event->flyer)
                    <p style="text-align: center"><img src="{{ ($orderDetail->event->flyer) ?url($orderDetail->event->flyer):'' }}"></p>
                @endif
                <p><strong>{{ $orderDetail->order->customer->full_name }} </strong> te ha enviado un tiquete para asistir al evento <strong>{{ $orderDetail->event->title }}</strong></p>
                <p><strong>Para asistir al evento debes de darte de alta en nuestra plataforma e introducir el codigo que tienes aqui abajo</strong></p>
                <h3>{{ $orderDetail->token_verify }}</h3>
                <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                    <tbody>
                    <tr>
                        <td align="left">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                <tr>
                                    <td> <a href="{{ url(route('portal.login')) }}" target="_blank">Registrarse</a> </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <br>
                Evento organizado por {{ $orderDetail->event->company->name }}<br>
                Fecha del evento {{ $orderDetail->event->start_date->toFormattedDateString() }}<br>
                Lugar {{ $orderDetail->event->address }}
            </td>
        </tr>
    </table>
@endsection