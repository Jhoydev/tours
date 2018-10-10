@extends('emails.layout')
@section('content')
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <h1>Hola</h1>
                @if ($email_to != $orderDetail->order->customer->email && $customer->email != $email_to)
                    <p>Se ha desvinculado de tu cuenta el tiqueta con código {{ $orderDetail->code }} por el comprador del tiquete {{ ucfirst($orderDetail->order->customer->full_name) }}</p>
                @elseif ($customer->id == $orderDetail->order->customer->id)
                    <p>Has desvinculado un tiquete para el evento {{ $orderDetail->event->title }}
                    y vuelve a estar sin asignar,
                    recuerda que puedes gestionar tus tiquetes desde el panel del evento dentro de tu panel de
                    {{ config('app.name', 'Laravel') }}
                    </p>
                @else
                    <p>{{ $customer->full_name }} con correo electrónico {{ $customer->email }}
                        ha rechazado el tiquete que le has enviado para el evento {{ $orderDetail->event->title }} y vuelve a estar sin asignar,
                        recuerda que puedes gestionar tus tiquetes desde el panel del evento dentro de tu panel de
                        {{ config('app.name', 'Laravel') }}
                    </p>
                @endif

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
                Evento organizado por {{ $orderDetail->event->company->name }}<br>
                Fecha del evento {{ $orderDetail->event->start_date->toDayDateTimeString() }}<br>
                Lugar {{ $orderDetail->event->address }}
            </td>
        </tr>
    </table>
@endsection