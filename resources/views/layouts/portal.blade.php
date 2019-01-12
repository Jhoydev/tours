<!DOCTYPE html>
<html lang="es">
<head>
    @include('layouts.template.head')
</head>
<body class="sidebar-fixed">
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
@include('layouts.template.nav', [
    'url_index' => url('portal/home'),
    'url_logout' => route('portal.logout'),
    'url_profile' => route('profile')
] )
<!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas sidebar-fixed" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <div class="nav-link">
                        <div class="profile-name">
                            <p class="name">
                                {{ ucfirst(Auth::user()->first_name) }}
                            </p>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('portal.home.index') }}"><i class="menu-icon fa fa-calendar"></i> <span class="menu-title">Mis Eventos</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('portal.home.history') }}"><i class="menu-icon fa fa-clock"></i> <span class="menu-title"> Eventos Anteriores</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}"><i class="menu-icon fa fa-calendar"></i> <span class="menu-title"> Ver Eventos</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.index') }}"><i class="menu-icon fa fa-shopping-cart"></i> <span class="menu-title"> Ordenes</span></a>
                </li>
                @stack('sidebar')
            </ul>
        </nav>
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @stack('navbar_items_right')
                @yield('content')
            </div>

            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="far fa-heart text-danger"></i></span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
@stack('modals')
@include('layouts.template.js')
</body>

</html>
