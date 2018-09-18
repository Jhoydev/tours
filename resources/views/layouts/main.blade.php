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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ mix('/css/main.css') }}" rel="stylesheet">

    @yield('link')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden sidebar-show">
<header class="app-header navbar pl-3 pr-5">

    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ url('/') }}" style="background-image: url({{ asset('img/logo-dark.png') }})"></a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav d-md-down-none">
        @stack('navbar_items_left')
    </ul>
    <ul class="nav navbar-nav ml-auto">
        @stack('navbar_items_right')
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
                    <a class="nav-link" href="{{ url('role') }}"><i class="fa fa-book"></i> Roles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('customer') }}"><i class="fa fa-users"></i> Asistentes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url("events") }}"><i class="icon-calendar"></i> Eventos</a>
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
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/pace.min.js') }}"></script>
<script src="{{ asset('js/coreui.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@yield('script')
@stack('scripts')
</body>
</html>