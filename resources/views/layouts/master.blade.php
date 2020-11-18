<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
<!--        <title>Pixie Dust Metaphysical Boutique in Sarasota, Florida</title>-->
        <title>@yield('title') | PixieDust</title>
        <meta name="keywords" content="@yield('keywords')">
        <meta name="description" content="@yield('description')"> 
        <link rel="shortcut icon" type="image/png" href="{{ asset('public/images/favicon.png') }}"/>

        <!-- Stylesheets
        ============================================= -->
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/stylesheet.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/owl.carousel.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/owl.transitions.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/responsive.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/stylesheet-skin2.css') }}" />
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Bitter' type='text/css'>
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/jqzoom.css') }}" />


        <!-- sort table -->

        <!-- jQuery lib -->
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>

        <!-- jPList core js and css  -->
        <link href="{{ asset('public/css/jplist.core.min.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('public/js/jplist.core.min.js') }}"></script>

        <!-- jPList sort bundle -->
        <script src="{{ asset('public/js/jplist.sort-bundle.min.js') }}"></script>

        <!-- jPList textbox filter control -->
        <script src="{{ asset('public/js/jplist.textbox-filter.min.js') }}"></script>
        <link href="{{ asset('public/css/jplist.textbox-filter.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- jPList pagination bundle -->
        <script src="{{ asset('public/js/jplist.pagination-bundle.min.js') }}"></script>
        <link href="{{ asset('public/css/jplist.pagination-bundle.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- jPList history bundle -->
        <script src="{{ asset('public/js/jplist.history-bundle.min.js') }}"></script>

        <!-- jPList toggle bundle -->
        <script src="{{ asset('public/js/jplist.filter-toggle-bundle.min.js') }}"></script>
        <link href="{{ asset('public/css/jplist.filter-toggle-bundle.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- jPList Price Range jQuery UI bundle js and css -->	
        <script  src="https://code.jquery.com/ui/1.12.0-rc.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0-rc.1/themes/smoothness/jquery-ui.css" />
        <link href="{{ asset('public/css/jplist.jquery-ui-bundle.min.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('public/js/jplist.jquery-ui-bundle.min.js') }}"></script>
        <script src="{{ asset('public/js/pixiedust-frontend.js') }}"></script>


        <!-- jPList start -->


        <!--end Sort table -->


    </head>
    <body>
        <div class="wrapper-wide">

            @include('includes.header')
            <div id="container">
                @yield('content')
            </div>
            @include('includes.footer')

        </div>

<!--  <script type="text/javascript" src="{{ asset('public/js/jquery-2.1.1.min.js') }}"></script>-->
        <script type="text/javascript" src="{{ asset('public/js/jqzoom.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/jquery.easing-1.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/jquery.dcjqaccordion.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/js/custom.js') }}"></script> 
        <script src="{{ asset('public/admin/dist/js/validator.js') }}"></script>
        <script src="{{ asset('public/admin/dist/js/pixiedust.js') }}"></script>
        <script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        </script>


        <script>
            $(document).ready(function () {
                $("#showlogin").click(function () {
                    $('#checkout-login').slideToggle(1000);
                });
            });

            function showShippingAddress() {
                $('#ship-box-info').slideToggle(1000);
            }
            function showCreatAccount() {
                $('#cbox_info').slideToggle(1000);
            }
        </script>

        @stack('script')
    </body>
</html>
