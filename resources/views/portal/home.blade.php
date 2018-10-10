@extends('layouts.portal')
@section('content')
    <div class="row mt-3">
        <div class="col-12 mb-3 text-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-lg rounded" data-toggle="modal" data-target="#modal-token">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Canjear Tiquete
            </button>
            <!-- Modal -->
            <div class="modal text-left fade" id="modal-token" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            {!! Form::open(['url' => url('portal/asiggn-by-token'),'method' => 'POST','id' => 'form-token']) !!}
                            <div class="container">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="token_ticket">Código de Tiquete</label>
                                        <input id="token_ticket" name="token" data-url="{{ url('api/verify-token') }}" type="text" class="form-control rounded"/>
                                        <span id="message-token" class="fade"></span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button id="btn-check-token" type="button" class="btn btn-light border rounded" onclick="checkTokenTicket()">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Comprobar
                                    </button>
                                    <button id="token_ticket_submit" type="submit" class="btn btn-success rounded" disabled>
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Canjear
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            @push('scripts')
            <script type="application/javascript">
                $('#modal-token').on('show.bs.modal',function (e) {
                    document.querySelector('#form-token').reset();
                    document.querySelector('#token_ticket').disabled = false;
                    document.querySelector('#btn-check-token').disabled = false;
                    document.querySelector('#message-token').innerHTML = "";
                    document.querySelector('#token_ticket_submit').disabled = true;
                });
                document.querySelector('#form-token').addEventListener('submit',function (ev) {
                    document.querySelector('#token_ticket').disabled = false;
                });
                function checkTokenTicket() {
                    let inp = document.querySelector('#token_ticket');
                    let btn_check = event.target;
                    let token = inp.value;
                    let message = document.querySelector('#message-token');
                    if (!token) return false;
                    let url = document.querySelector('#token_ticket').dataset.url;
                    fetch(url+"?token="+token)
                        .then(response => response.json())
                        .then(res => {
                            let btn = document.querySelector('#token_ticket_submit');
                            if(res.status){
                                btn.disabled = false;
                                inp.disabled = true;
                                btn_check.disabled = true;
                                message.innerHTML = `Código correcto <i class="fa fa-check text-success" aria-hidden="true"></i>`;
                            }else{
                                btn.disabled = true;
                                message.innerHTML = `Código incorrecto <i class="fa fa-remove text-danger" aria-hidden="true"></i>`;
                            }
                            message.classList.add('show');
                        });
                }

            </script>
            @endpush
        </div>
    </div>
    <div class="row ">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Bienvenido {{ ucfirst(Auth::user()->first_name) }}</h1>
                    <div class="row justify-content-center mb-3">
                        <div class="col-12">
                            <h3 class="text-center">Mis eventos</h3>
                            <hr>
                        </div>
                        @foreach($details as $detail)
                            @php($event = $detail->event)
                            <div class="col-lg-6">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary border-primary">
                                        <div class="d-flex justify-content-between">
                                            <span><strong class="h3">{{ $event->title }}</strong></span>
                                            <span><i class="fa fa-calendar" aria-hidden="true"></i> {{ $event->start_date->toFormattedDateString() }}</span>
                                            @if($event->start_date > now() && $event->page)
                                                <div><a class="badge badge-warning" href="{{ url('evento/' . $event->id . '/' . $event->page->id ) }}" target="_blank">Ir a la web <i class="fa fa-external-link" aria-hidden="true"></i></a></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body row justify-content-center">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-primary rounded mr-3" data-toggle="tooltip" data-placement="top" title="Panel de Control" href="{{ route('customer.event',['id' => $event->id]) }}"><i class="fa fa-home" aria-hidden="true"></i> Panel</a>
                                                @if($event->memories_url)
                                                <button class="btn btn-light border rounded mr-3" data-toggle="tooltip" data-placement="top" title="Descargar Memorias"><i class="fa fa-download" aria-hidden="true"></i></button>
                                                @endif
                                                <button class="btn btn-light border rounded mr-3" data-toggle="tooltip" data-placement="top" title="Descargar Certificado"><i class="fa fa-download" aria-hidden="true"></i></button>
                                            </div>
                                            <hr>
                                        </div>

                                        @foreach($event->orderDetailsByCustomer as $my_detail)
                                            <div class="col-lg-4">
                                                <div class="card border-success">
                                                    <div class="card-header text-white bg-success ">
                                                        {{ $my_detail->ticket->title }}
                                                    </div>
                                                    <div class="card-body text-center">
                                                        {{ $my_detail->ticket->description }}
                                                        <hr>
                                                        ${{ number_format($my_detail->price,2) }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection