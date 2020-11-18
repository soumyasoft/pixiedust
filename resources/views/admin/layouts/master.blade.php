<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | PixieDust Admin</title>
        <link rel="shortcut icon" type="image/png" href="{{ asset('public/images/favicon.png') }}"/>
        <link rel="stylesheet" href="{{ asset('public/admin/plugins/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('public/admin/plugins/datatables/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('public/admin/plugins/datepicker/jquery-ui.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/admin/dist/css/pixiedust-admin.css') }}">
        <!-- iCheck -->

        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    </head>
    <body class="hold-transition sidebar-mini">
        <div  class="wrapper">
            <!--Hedaer-->
            @include('admin.includes.header')
            <!--Hedaer--> 

            <!--Sidebar-->
            @include('admin.includes.sidebar')
            <!--Sidebar-->

            @yield('content')

            @include('admin.includes.footer')

        </div>

        <!-- Scripts -->
        <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
$.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- AdminLTE App -->
        <script src="{{ asset('public/admin/dist/js/adminlte.js') }}"></script>

        <!-- DataTables -->
        <script src="{{ asset('public/admin/plugins/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('public/admin/plugins/datatables/dataTables.bootstrap4.js') }}"></script>        
        <script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>
        <script src="{{ asset('public/admin/dist/js/validator.js') }}"></script>
        <script src="{{ asset('public/admin/dist/js/pixiedust.js') }}"></script>

        <script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
});

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

        @stack('script')

    </body>

</html>
