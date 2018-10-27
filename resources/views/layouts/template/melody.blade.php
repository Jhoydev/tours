<!DOCTYPE html>
<html lang="es">
<head>
    @include('layouts.template.head')
</head>
<body class="sidebar-fixed">
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layouts.template.nav')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        @include('layouts.template.sidebar-left')
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
@include('layouts.template.js')
</body>

</html>
