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
                    <p class="display-5 text-center">Bienvenido {{ ucfirst(Auth::user()->first_name) }}</p>
                    <div class="row justify-content-center mb-3">
                        <div class="col-12 mb-3">
                            <h3 class="text-center">Mis eventos</h3>
                        </div>
                        @foreach($details as $detail)
                            @php($event = $detail->event)
                            <div class="col-lg-6">
                                <p><strong class="badge badge-pill badge-success">{{ $event->company->name }}</strong> <span class="badge badge-info badge-pill"> {{ $event->eventStatus->name }}</span></p>
                                <div class="card border-primary">
                                    <div class="card-header bg-primary border-primary text-white">
                                        <div class="row">
                                            <div class="col-12"><p><strong class="h3">{{ $event->title }}</strong></p></div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-6"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $event->start_date->toFormattedDateString() }}</div>
                                                    @if($event->end_date > now() && $event->page && $event->page->slug)
                                                        <div class="col-md-6 text-right"><a class="badge badge-warning badge-pill" href="{{ url('evento/' . $event->page->slug ) }}" target="_blank">Ir a la web <i class="fas fa-external-link-alt"></i></a></div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-12 mb-3">
                                            @if ($event->start_date < now() && $event->event_status_id < 4)
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-primary rounded mr-3" data-toggle="tooltip" data-placement="top" title="Panel de Control" href="{{ route('customer.event',['id' => $event->id]) }}"><i class="fa fa-home" aria-hidden="true"></i> Panel</a>
                                                @if($event->memories_url)
                                                <a href="{{ $event->memories_url }}" target="_blank" class="btn btn-light border rounded mr-3" data-toggle="tooltip" data-placement="top" title="Descargar Memorias"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                @endif
                                                {{--<button class="btn btn-light border rounded mr-3" data-toggle="tooltip" data-placement="top" title="Descargar Certificado"><i class="fa fa-download" aria-hidden="true"></i></button>--}}
                                            </div>
                                            @endif
                                        </div>
                                        @if($event->flyer)
                                            <div class="row justify-content-center mb-3">
                                                <div class="col-md-8">
                                                    <img src="{{ ($event->flyer) ?url($event->flyer):'' }}" class="img-fluid shadow" style="min-width: 100%; min-height:150px"  alt="">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row justify-content-center">
                                            @foreach($event->orderDetailsByCustomer as $my_detail)
                                                <div class="col-lg-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <i class="fa fa-ticket-alt" aria-hidden="true"></i> {{ $my_detail->ticket->title }}
                                                            <span class="badge badge-info badge-pill text-white pull-right">{{ $my_detail->ticket->type }}</span>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            {{ $my_detail->ticket->description }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

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