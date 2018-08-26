<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="/img/favicon.png">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <!-- Icons -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ mix('css/main.css') }}" rel="stylesheet">
    @yield('link')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden sidebar-mobile-show sidebar-minimized brand-minimized">
<header class="app-header navbar pl-3 pr-5">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ url('/') }}" style="background-image: url({{ asset('img/logo-dark.png') }})"></a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
            <a class="nav-link" href="{{ url('events') }}"><i class="icon-calendar"></i> Eventos</a>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false" style="position: relative;padding-left: 50px">
                <img style="width: 32px; height: 32px; position: absolute;top: -6px; left: 10px; border-radius: 50%" class="img-fluid" src="{{ url("user/avatar/".Auth::user()->company_id."/".Auth::user()->id) }}" alt="">
                {{ ucfirst(Auth::user()->first_name) }}
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Cuenta</strong>
                </div>
                <a class="dropdown-item" href="{{ url('user/'.Auth::user()->id.'/edit') }}">
                    <i class="fa fa-user-o"></i> Perfil
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Salir
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</header>

<div class="app-body">
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('user') }}"><i class="fa fa-user"></i> Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('role') }}"><i class="fa fa-users"></i> Roles</a>
                </li>
                @stack('sidebar')
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>

    <!-- Main content -->
    <main class="main">

        <div class="container-fluid">
            @yield('content')
        </div>
        <!-- /.conainer-fluid -->
    </main>

</div>
@stack('modals')

<!-- Bootstrap and necessary plugins -->
<script src="{{ mix('js/main.js') }}"></script>
<script src="{{ asset('js/pace.min.js') }}"></script>
<script src="{{ asset('js/coreui.js') }}"></script>
<script type="text/javascript">
    function showAlertError(errors){
            var texto = '';
            $.each(errors, function(key,value) {
                 texto += `<li>${value}</li>`;
             }); 
            var alert = `
                <div id="alert-ajax" class="alert alert-danger alert-dismissible fade show mt-2 animated bounceInDown" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>${texto}</ul>
                </div>`;
            $("#alert-ajax").remove();
            $('main > .container-fluid').prepend(alert);
        }
        function showAlertSuccess(mensaje){
            var alert = `
            <div id="alert-ajax" class="alert alert-success alert-dismissible fade show animated bounceInDown mt-2" role="alert">
                <p>${mensaje}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>`;
            $("#alert-ajax").remove();
            $('main > .container-fluid').prepend(alert);
            
        }
</script>
@yield('script')
@stack('scripts')
</body>
</html>