<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="/img/favicon.png">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <!-- plugins:css -->
    <link rel="stylesheet" href="/template/vendors/iconfonts/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="/template/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/template/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/template/css/style.css">
    <!-- endinject -->
    @yield('link')
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
<script src="{{ mix('js/main.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="/template/vendors/js/vendor.bundle.base.js"></script>
<script src="/template/vendors/js/vendor.bundle.addons.js"></script>

<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="/template/js/off-canvas.js"></script>
<script src="/template/js/hoverable-collapse.js"></script>
<script src="/template/js/misc.js"></script>
<script src="/template/js/settings.js"></script>
<script src="/template/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="/template/js/dashboard.js"></script>
<!-- End custom js for this page-->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
    $('[data-toggle="tooltip"]').tooltip();
</script>

@yield('script')
@stack('scripts')
</body>

</html>
