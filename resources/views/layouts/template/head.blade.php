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
