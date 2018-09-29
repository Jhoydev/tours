<!doctype html>
<html lang="en">
<head>
    <title>Email</title>
</head>
<body>
    <h1>Hola</h1>
    <p>{{ $orderDetail->order->customer->full_name }} te ha enviado un tiquete para asistir al evento {{ $orderDetail->event->title }}</p>
    <p>Para asistir al evento debes de darte de alta en nuestra plataforma e introducir el codigo que tienes aqui abajo</p>
    <p>{{ $orderDetail->token_verify }}</p>
    <a href="{{ url(route('portal.login')) }}" target="_blank">Registrarse</a>
    <br><br>
    <p>Evento organizado por {{ $orderDetail->event->company->name }}</p>
    <p>Fecha del evento {{ $orderDetail->event->start_date }}</p>
    <p>Lugar {{ $orderDetail->event->address }}</p>
</body>
</html>