<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Brands</title>

    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor2/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor2/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor2/linearicons/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor2/chartist/css/chartist-custom.css') }}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}"> --}}
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor2/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor2/select2/select2.min.css') }}">
    <!-- Loader CSS -->
    {{-- <link href="{{ asset('assets/vendor2/loader/css/introLoader.css') }}" rel="stylesheet"> --}}
    <!-- End Loader CSS -->

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    @yield('styles')
    <style>
        .login-back{
            background-image: url({{asset('images/login/BACKGROUND.PNG')}});
            background-color: #ec982f !important;
            background-repeat: no-repeat;
            background-size: 100% auto;
            background-position: center top;
            background-attachment: fixed;
        }
        .vl {
            border-left: 2px solid #FFF;
            height: inherit;
        }
        .h-logo{
            margin: 0;
            padding: 0;
            color: #FFF;
            font-weight: bold;
            opacity: 0.3;
            bottom: -9px;
            position: relative;
            font-style: italic;
            font-size: 5rem;
        }
        .p-side{
            font-size: 3rem;
            color: #FFF;
            font-style: italic;
            font-weight: bold;
            margin: 0;
            padding: 0;
        }
        .p-d-none{
            display: none;
        }
    </style>

</head>
<body class="login-back">
  <div id="element" class="introLoading"></div>
    <div id="wrapper">

        <div class="main login-back">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
        <!-- END MAIN -->
        <div class="clearfix"></div>
        <footer>
            <div class="container-fluid">
                <!-- <p class="copyright">Designed & Developed by <i class="fa fa-love"></i><a href="https://www.codingclips.com/" target="_blank" class="text-red">Coding Clips</a>
                </p> -->
            </div>
        </footer>
    </div>
    <!-- Javascript -->
    <script src="{{ asset('assets/vendor2/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor2/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor2/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/vendor2/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor2/chartist/js/chartist.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/scripts/klorofil-common.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor2/toastr/toastr.js') }}"></script>
    <script src="{{ asset('js/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor2/select2/select2.min.js') }}"></script>

    <!-- End Loader JS -->
    <script>
        $(document).ready(function() {
            // $(document).ready(function() {
            //     $('.js-example-basic-single').select2();
            // });
            $('.selectPlugin').select2({
                placeholder: "Select",
                allowClear: true
            });
        });
    </script>

    <script>

        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}")
        @endif

        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}")
        @endif

    </script>
    <script>
        toastr.options = {
          "closeButton": true,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
    </script>
    <script>
        function myFunction() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
    </script>

    @yield('scripts')

</body>
</html>
