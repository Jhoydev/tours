@extends('emails.layout')
@section('content')
    <table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <h1>Hola</h1>
                Lo sentimos pero el evento {{ $event->title }} ha sido cancelado
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
            </td>
        </tr>
    </table>
@endsection