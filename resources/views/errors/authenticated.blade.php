<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="/img/favicon.png">
    <title>{{ config('app.name', 'Laravel') }} - Portal</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <!-- Icons -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ mix('/css/main.css') }}" rel="stylesheet">

</head>
<body>

<div class="container h-100 d-flex justify-content-center" style="height: 100vh !important">
    <div class="row my-auto text-center">
        <div class="col-12">
            <p class="display-1 text-center">!!UPS <i class="fa fa-lock"></i></p>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p>Ya estas autenticado con una cuenta de cliente por favor cerra sesión y vuelve a entrar</p>
                    <hr>
                    <a class="mr-5" href="{{ url()->previous() }}">Atras</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>