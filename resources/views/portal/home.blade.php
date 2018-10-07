@extends('layouts.portal')
@section('content')
    <div class="row mt-5">
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
        <div class="col-12">
            <div class="card rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" id="url-calendar" value="{{ url('api/calendar/customer/'.Auth::user()->id) }}">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $("#calendar").fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month'
                },
                events: {
                    url: document.querySelector('#url-calendar').value,
                }
            });
        })
    </script>
@endpush