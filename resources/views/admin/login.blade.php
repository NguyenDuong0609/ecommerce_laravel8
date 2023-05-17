<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ env('MIX_SENTRY_DSN_PUBLIC') }}/AdminLTE-3.1.0/plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition login-page">
    <div id="app">
        <login-component></login-component>
    </div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script><!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- Toastr -->
    <script src="{{ env('MIX_SENTRY_DSN_PUBLIC') }}/AdminLTE-3.1.0/plugins/toastr/toastr.min.js"></script>
</body>
</html>
