@extends('layouts.portal')
@section('content')
    @push('sidebar')
    @include('events.sidebar')
    @endpush
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="display-5 text-center"><i class="fa fa-ticket" aria-hidden="true"></i> {{ $ticket->event->title }}</p>
                    <p class="display-3 font-weight-bold text-center"><i class="fa fa-ticket-alt" aria-hidden="true"></i> {{ $ticket->title }}</p>
                    <hr>
                    @foreach($orders as $order)
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="d-flex justify-content-between">
                                    <div class="mr-3"><i class="fa fa-send" aria-hidden="true"></i> Enviadas <span class="badge badge-pill badge-info">{{ count($order->orderDetails) }}</span></div>
                                    <span class="mr-3"><i class="fa fa-calendar" aria-hidden="true"></i> Fecha de envío {{ $order->created_at }}</span>
                                    {!! Form::open(['url' => url("events/$order->event_id/tickets/$ticket->id/send-tickets/$order->id"),'method' => 'DELETE']) !!}
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            @foreach($order->orderDetails as $detail)
                                <div class="col-lg-auto">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <span><i class="fa fa-ticket-alt" aria-hidden="true"></i> Nº {{ $detail->id }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                    @endforeach

                    @push('scripts')
                    @include('layouts.js.datatable')
                    <script>
                        $(".radio-assign").on('click',function () {
                            let content = $(this).closest(".content-radios");
                            let radios = content.find('.radio-assign');
                            radios.each(function (k,radio) {
                                radio = $(radio);
                                let target = radio.data('target');
                                if (radio.prop('checked')){
                                    $("#"+target).removeClass('d-none');
                                }else{
                                    $("#"+target).addClass('d-none');
                                }
                            })
                        });
                        function confirmAssign() {
                            let form = event.target;
                            let email = $(form).find('input[type=email]').val();
                            if (!confirm("Enviar tiquete al correo electronico " + email)){
                                event.preventDefault();
                            }
                        }
                    </script>
                    @endpush
                </div>
            </div>
        </div>
    </div>
@endsection
