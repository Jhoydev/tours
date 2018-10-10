@extends('layouts.portal')
@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-right"><a href="{{ route('event.page',[$data['event_id'],$data['page_id']]) }}">volver a la pagina del evento</a></p>
                    <p class="h1 my-5 text-right">Detalle de Compra</p>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Evento</strong> {{ $event->title }}</p>
                            <ul class="list-unstyled">
                                <li>{{ $event->address }},{{ $event->cp }} - {{ $event->city->name }}</li>
                                <li>{{ $event->start_date->toFormattedDateString() }}</li>
                            </ul>
                        </div>
                        <div class="col-md-6 text-right">
                            <p><strong>Factura para</strong></p>
                            <ul class="list-unstyled">
                                <li>{{ Auth::user()->full_name }}</li>
                                <li>{{ Auth::user()->document_type->name }} {{ Auth::user()->document }}</li>
                                <li>{{ Auth::user()->address }}, {{ Auth::user()->zip_code }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-unstyled">
                                <li>Fecha: {{  \Carbon\Carbon::now()->toFormattedDateString() }}</li>
                            </ul>
                            <div class="alert alert-info" role="alert">
                                <ul class="list-unstyled">
                                    <li class="media">
                                        <i class="fa fa-info-circle mr-3" style="font-size: 36px" aria-hidden="true"></i>
                                        <div class="media-body">
                                            <strong> {{ $event->pre_order_display_message }}</strong>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive mt-4">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Descripción</th>
                                        <th class="text-right">Cantidad</th>
                                        <th class="text-right">Coste Unitario</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $cont_ticket = 1;
                                        $total = 0;
                                    @endphp
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td scope="row">{{ $cont_ticket }}</td>
                                            <td>
                                                <strong>Tiquete: {{ $ticket->title }}</strong> - {{ $ticket->description }}
                                            </td>
                                            <td class="text-right">{{ $data_ticket[$ticket->id]['qty'] }}</td>
                                            <td class="text-right">$ {{number_format($ticket->price, 2) }}</td>
                                            <td class="text-right">$ {{number_format($data_ticket[$ticket->id]['qty'] * $ticket->price, 2) }}</td>
                                        </tr>
                                        @php
                                            $cont_ticket++;
                                            $total += $data_ticket[$ticket->id]['qty'] * $ticket->price;
                                        @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">
                            <p class="h1">Total: $ {{ number_format($total, 2) }}</p>
                        </div>
                    </div>
                    <form action="{{ route('shop.store') }}" id="form_order" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <div class="row">
                            <div class="col-12">
                                @if ($event->enable_offline_payments)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="method_payment" id="inlineRadio1" value="offline_payments">
                                    <label class="form-check-label" for="inlineRadio1">Pago con efectivo</label>
                                </div>
                                @endif
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="method_payment" id="inlineRadio2" value="online_payment">
                                    <label class="form-check-label" for="inlineRadio2">Pago con tarjeta</label>
                                </div>
                            </div>
                            <div class="col-12">
                                @if ($event->enable_offline_payments)
                                    <div id="content_offline_payment_instructions" class="alert alert-success mt-3 fade" role="alert">
                                        <ul class="list-unstyled">
                                            <li class="media">
                                                <i class="fa fa-check-circle mr-3" style="font-size: 36px" aria-hidden="true"></i>
                                                <div class="media-body">
                                                    <strong> {{ $event->offline_payment_instructions }}</strong>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="col-12 text-right">
                                <hr>
                                <button type="submit" id="pay_button" class="btn btn-success btn-lg rounded fade">Pagar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('input[type=radio][name=method_payment]').change(()=>{
            if ($("#inlineRadio1").prop("checked")){
                $("#content_offline_payment_instructions").addClass('show');
                $("#form_order").find('button[type=submit]').text('Confirmar');
            }else{
                $("#content_offline_payment_instructions").removeClass('show');
                $("#form_order").find('button[type=submit]').text('Pagar');
            }
            $("#form_order").find('button[type=submit]').addClass('show');

        });
        
        
        $("#form_order").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                   type: "POST",
                   url: url,
                   data: form.serialize(),
                   success: function(data)
                   {
                       alert(data);
                   }
                 });

        });
    </script>
@endpush