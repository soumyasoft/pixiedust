<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Pixiedust Admin Login</title>    
        <link rel="shortcut icon" type="image/png" href="{{ asset('public/images/favicon.png') }}"/>

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/admin/dist/css/pixiedust-admin.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">        
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="javascript:void(0);"><img src="{{ asset('public/images/admin-logo.png') }}"></a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                @yield('content')

            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('public/admin/dist/js/validator.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
