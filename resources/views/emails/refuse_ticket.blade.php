@extends('emails.layout')
@section('content')
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <h1>Hola</h1>
                @if($orderDetail->event->flyer)
                    <p style="text-align: center"><img src="{{ url($orderDetail->event->flyer) }}"></p>
                @endif
                <p class="align-center">Has recibido un Tiquete</p>
                <p class="align-center">Evento</p>
                <h2 class="align-center"><strong>{{ $orderDetail->event->title }}</strong></h2>
                @if ($orderDetail->customer_id != $orderDetail->order->customer_id)
                    <p><strong>{{ $orderDetail->order->customer->full_name }} </strong> te ha enviado un tiquete para asistir este evento.</p>
                @endif
                @if ($orderDetail->token_verify)
                    <p><strong>Para asistir al evento debes de darte de alta en nuestra plataforma e introducir el codigo que tienes aqui abajo</strong></p>
                    <h3>{{ $orderDetail->token_verify }}</h3>
                    <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                        <tbody>
                        <tr>
                            <td align="left">
                                <table border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                    <tr>
                                        <td> <a href="{{ url('portal/register') }}" target="_blank">Registrarse</a> </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                @else
                    <p>Puedes verlo desde tu panel de <a href="{{ url('portal') }}" target="_blank">{{ config('app.name', 'Laravel') }}</a></p>
                @endif
                <br>
                Evento organizado por {{ $orderDetail->event->company->name }}<br>
                Fecha del evento {{ $orderDetail->event->start_date->toDayDateTimeString() }}<br>
                Lugar {{ $orderDetail->event->address }}
            </td>
        </tr>
    </table>
@endsection<?php
/**
 * Created by PhpStorm.
 * User: jhoy
 * Date: 09/10/2018
 * Time: 16:19
 */