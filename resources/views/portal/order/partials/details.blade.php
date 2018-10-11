<div class="row">
    @foreach($details as $detail)
        <div class="col-md-4">
            <div class="card rounded {{ (!$detail->customer) ? 'border border-warning' : '' }}">
                <div class="card-body">
                    <p class="text-center"><span class="badge badge-info">{{ $detail->ticket->type }}</span></p>
                    <p class="text-center h1">{{ $detail->ticket->title }}</p>
                    <p class="text-center h2">${{ number_format($detail->price,2) }}</p>
                    @if ($detail->customer)
                        <p class="text-center">{{ $detail->customer->full_name }} - {{ $detail->customer->email }}</p>
                        <div class="d-flex justify-content-center">
                            {!! Form::open(['url' => url("portal/ticket/$detail->id"),'method' => 'DELETE']) !!}
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded"><i class="fa fa-chain-broken" aria-hidden="true"></i> Desvincular</button>
                            {!! Form::close() !!}
                        </div>
                    @elseif($detail->send_to_email)
                        <p class="text-center">Esperando que el usuario con correo {{ $detail->send_to_email }} acepte el tiquete</p>
                        <div class="d-flex justify-content-center">
                            {!! Form::open(['url' => url("portal/ticket/$detail->id"),'method' => 'POST']) !!}
                            <button class="btn btn-outline-info btn-sm rounded mr-2"><i class="fa fa-repeat" aria-hidden="true"></i> Reenviar</button>
                            {!! Form::close() !!}

                            {!! Form::open(['url' => url("portal/ticket/$detail->id"),'method' => 'DELETE']) !!}
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded"><i class="fa fa-chain-broken" aria-hidden="true"></i> Desvincular</button>
                            {!! Form::close() !!}
                        </div>
                    @else
                        <div class="content-radios mb-3">
                            <div class="form-check">
                                <input class="form-check-input radio-assign" type="radio" name="check_assign_{{ $detail->id }}" id="check_assign_{{ $detail->id }}_1" value="1" data-target="form-assign-ticket-owner_{{ $detail->id }}" checked>
                                <label class="form-check-label" for="check_assign_{{ $detail->id }}_1">
                                    Asignar este tiquete a mi usuario
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input radio-assign" type="radio" name="check_assign_{{ $detail->id }}" id="check_assign_{{ $detail->id }}_2" value="2" data-target="form-assign-ticket_{{ $detail->id }}">
                                <label class="form-check-label" for="check_assign_{{ $detail->id }}_2">
                                    Envíar código de tiquete por correo
                                </label>
                            </div>
                        </div>
                        <form id="form-assign-ticket-owner_{{ $detail->id }}" action="{{ url("portal/events/order/assign-ticket/$detail->id") }}"  method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="hidden" name="owner" value="1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success rounded" type="submit"><i class="fa fa-check" aria-hidden="true"></i>
                                        Asignar</button>
                                </div>
                            </div>
                        </form>
                        <form id="form-assign-ticket_{{ $detail->id }}" class="d-none" action="{{ url("portal/events/order/assign-ticket/$detail->id") }}" onsubmit="confirmAssign()" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="email" class="form-control rounded-left" name="email" placeholder="Introduce un correo electronico" aria-label="Introduce el correo" aria-describedby="basic-addon2" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success rounded-right" type="submit"><i class="fa fa-send" aria-hidden="true"></i>
                                        Enviar</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
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