<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.template.head')
</head>
<body class="app flex-row align-items-center">
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
            <div class="row flex-grow">
                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="auth-form-transparent text-left p-3">
                        <div class="brand-logo">
                            <img src="{{ asset('img/logo-insignia-agencia.png') }}" alt="logo">
                        </div>
                        @yield('content')
                    </div>
                </div>
                @yield('login_half_bg')
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
@include('layouts.template.js')
</body>
</html>