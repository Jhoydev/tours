<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web del evento</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">
</head>
<body style="color:{{ $page->color_text }}; background-position: center; background-repeat: no-repeat; background-size: cover; background-image: url({{ $page->background }});">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="#">Insignia</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">

            </ul>
            <ul class="navbar-nav">
                @if (Auth::guard()->check())

                @else
                    <li class="nav-item">
                        <a class=" btn btn-sm btn-primary rounded" href="{{ route('portal.login') }}"><i class="fa fa-user"></i> Iniciar sesión</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container" style="margin-top: 100px">
    @if (Auth::guard('web')->check())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <p>Ya estas autenticado en otro tipo de cuenta, por favor cierra esa sesión para poder realizar esta.</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card rounded" style="background-color: rgba(255, 255,255, 0.9)">
                <div class="card-body text-center">
                    <h1 class="text-center">{{ $event->title }}</h1>
                    <p>{!! $event->description !!}</p>
                    <p><i class="icon-calendar"></i> {{ $event->start_date }}</p>
                    <hr>
                    <div class=" d-flex justify-content-around">
                        <div>
								<span class="fa-stack fa-lg">
								  <i class="fa fa-circle fa-stack-2x text-primary"></i>
								  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
								</span>
                            <strong>Facebook</strong>
                        </div>
                        <div>
								<span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x text-primary"></i>
									<i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
								</span>
                            <strong>Linkedin</strong>
                        </div>
                        <div>
								<span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x text-danger"></i>
									<i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
								</span>
                            <strong>Google plus</strong>
                        </div>
                        <div>
								<span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x text-info"></i>
									<i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
								</span>
                            <strong>Twitter</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card rounded" style="background-color: rgba(255, 255,255, 0.9)">
                <div class="card-body">
                    <div class="text-center">
                        <p class="h2">Tiquetes</p>
                        <p>Compra aquí tus tiquetes</p>
                    </div>
                    <form method="GET" action="{{ route('shop') }}" class="px-5 py-3" id="form-shopping-cart">
                        @csrf
                        <div class="row mt-3 d-flex justify-content-center">
                            <input type="hidden" name="reference" value="{{ \Illuminate\Support\Str::uuid() }}">
                            <input type="hidden" id="buy_json" name="buy_json">
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <input type="hidden" name="page_id" value="{{ $page->id }}">
                            @foreach ($event->tickets as $ticket)
                                @if ($ticket->quantity_available)
                                    <div class="col-md-auto">
                                        <div class="card border-info rounded">
                                            <div class="card-body text-center my-5 ticket" data-code="{{ $ticket->id }}" data-quantity_available="{{ $ticket->quantity_available }}">
                                                <p class="h3 font-weight-bold">{{ $ticket->title }}</p>
                                                <p class="h1"><strong>{{ $ticket->price }}$</strong></p>
                                                <p>{{ $ticket->description }}</p>
                                                <div class="d-flex align-items-center justify-content-center content-shopping-cart">
                                                    <input type="number" class="form-control form-control-sm ml-2 rounded text-center inp-number"
                                                           style="width: 5em;" max="{{ $ticket->max_per_person }}" min="{{ $ticket->min_per_person }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-auto">
                                        <div class="card border-light rounded">
                                            <div class="card-body text-center my-5 ticket text-muted">
                                                <p class="h3 font-weight-bold">{{ $ticket->title }}</p>
                                                <p class="h1"><del>{{ $ticket->price }}$</del></p>
                                                <p><del>{{ $ticket->description }}</del></p>
                                                <div class="d-flex align-items-center justify-content-center content-shopping-cart">
                                                    <strong class="h4 text-danger">AGOTADO</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if (Auth::guard('web')->check())
                                <div class="col-12 text-center">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <p>Has iniciado sesión en la aplicacion de gestión, si desear realizar una compra debes de cerrar esa sesión.</p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <div class="col-12 text-center">
                                    <button id="btn-buy" class="btn btn-lg btn-warning rounded fade" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Comprar</button>
                                </div>
                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3 d-flex justify-content-center">
        <div class="col-auto">
            <div class="card rounded" style="background-color: rgba(255, 255,255, 0.9)">
                <div class="card-body text-center">
                    <p>Ubicación</p>
                    <p class="h5">{{ $event->address }}</p>
                    <div class="mt-3 text-center" id="map">
                        <img class="img-fluid" style="max-height: 350px" src="{{ asset('img/map_event.jpg') }}">
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<nav class="navbar navbar-light bg-light justify-content-center mt-5">
    <a class="navbar-brand" href="#">Desarrollado por Insignia</a>
</nav>
<script src="{{ mix('js/main.js') }}"></script>
<script>
    /* Events Listener*/
    const inp_number = $(".inp-number");
    const btn_buy = $("#btn-buy");
    inp_number.keydown(()=> {
        /* Evitar los signos en el input number*/
        if (
            event.keyCode === 69 ||
            event.keyCode === 106 ||
            event.keyCode === 107 ||
            event.keyCode === 109 ||
            event.keyCode === 188 ||
            event.keyCode === 190 ||
            event.keyCode === 189 ||
            event.keyCode === 111 ||
            event.keyCode === 187
        ) return false;
    });

    inp_number.change(checktickets);

    function checktickets(){
        let inp = $(this);
        if (parseInt(inp.val()) > inp.attr('max')){
            inp.val(inp.attr('max'));
        }
        let quantity_available = parseInt(inp.closest('.ticket').data('quantity_available'));
        //quantity_available = $(quantity_available).attr('quantity_available');
        if (parseInt(inp.val()) > quantity_available){
            inp.val(quantity_available);
        }
        if (parseInt(inp.val()) < inp.attr('min')){
            inp.val(inp.attr('min'));
        }
        let checkComprar = false;
        inp_number.each(function (index,el){
            if (parseInt(el.value) > 0){
                checkComprar = true;
            }
        });
        btn_buy.removeClass('show');
        if (checkComprar){
            btn_buy.addClass('show');
        }
    }

    $("#form-shopping-cart").submit(function(ev){
        let arr_shopping_cart = [];
        $(".ticket").each((i,e)=>{
            if ($(e).find('.inp-number').val()){
                let value = {
                    'id' : $(e).data('code'),
                    'qty' : $(e).find('.inp-number').val(),
                };
                arr_shopping_cart.push(value);
            }
        });
        if (arr_shopping_cart.length > 0){
            $("#buy_json").val(JSON.stringify(arr_shopping_cart));
        }else{
            ev.preventDefault();
        }
    });
</script>
</body>
</html>