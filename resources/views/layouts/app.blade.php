<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ Setting::get('site_title') }}</title>
<link rel="shortcut icon" type="image/png" href="{{ img(Setting::get('site_icon')) }}"/>

<!-- Font Awesome CSS -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- Ionicons CSS -->
<link href="ionicons/css/ionicons.min.css" rel="stylesheet">
<!-- Materail Design CSS -->
<link href="material-icons/css/materialdesignicons.min.css" rel="stylesheet">
<!-- Font -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
<!-- lib -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- data table -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css') }}">
<!-- custom style -->
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@yield('styles')
</head>
@if(country() == 'US')
<!-- WORLD MAP BODY CSS -->
<body class="bodysection-map">
@else
<!-- US MAP BODY CSS -->
<body class="bodysection">
@endif
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="logo navbar-brand" href="{{ url('/') }}">
                       <img src="{{ img(Setting::get('site_logo')) }}" height="50" alt="{{ Setting::get('site_title') }}">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li><a href="{{ url('/home') }}">Home</a></li>
                            <li><a href="{{ url('transaction') }}">Transactions</a></li>
                            <!-- <li><a href="{{ url('download') }}">Download forms</a></li> -->
                            <!-- <li><a href="{{ url('/referral') }}">Referral</a></li> -->
                            <li><a href="{{ url('/profile') }}">Divident + Payout</a></li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content-wrapper">
            @include('common.notify')
            @yield('content')
        </div>


        <footer class="footer bg-img p-80">
            <div class="container">
                <!-- Foot Top Starts -->
                <div class="foot-top row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="foot-logo">
                            <img class="img-responsive" src="{{ img(Setting::get('site_logo')) }}" alt="{{ Setting::get('site_title') }}">
                        </div>
                    </div>
                    <div class="foot-top-right col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                        <ul class="list-unstyled list-inline social-list">

                            <li><a href="https://www.linkedin.com/company/aarnav/" class="social-item" target="_blank"><i class="mdi mdi-linkedin"></i></a></li>
                            <li><a href="https://twitter.com/Aarnavtoken" class="social-item" target="_blank"><i class="mdi mdi-twitter"></i></a></li>
                            <li><a href="https://t.me/aarnav_token" class="social-item" target="_blank"><i class="mdi mdi-telegram"></i></a></li>
                            <li><a href="https://www.facebook.com/Aarnav-1724687394261783" class="social-item" target="_blank"><i class="mdi mdi-facebook"></i></a></li>
                            <li><a href="https://medium.com/@aarnavtoken" class="social-item" target="_blank"><i class="mdi mdi-medium"></i></a></li>

                        </ul>
                    </div>
                    @if(!Auth::user())
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <a href="#" class="whitepaper-link"><span>Signup &amp; Buy Tokens</span></a>
                        </div>
                    @endif
                </div>
                <!-- Foot Top Ends -->
                <!-- Foot Bottom Starts -->
                <div class="foot-btm row text-center">
                    <ul class="foot-btm-list list-unstyled list-inline">
                        <li>
                            <a href="https://aarnav.io/privacy-policy.html" class="foot-link">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="https://aarnav.io/terms.html" class="foot-link">Terms &amp; Conditions</a>
                        </li>
                        <li>
                            <a href="https://aarnav.io/contact-us.html" class="foot-link">Contact Us</a>
                        </li>
                    </ul>
                </div>
                <!-- Foot Bottom Ends -->
            </div>
        </footer>
    </div>
    <!-- jquery.min.js -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <!-- Upload Doc -->
    <script type="text/javascript" src="{{ asset('js/jquery.uploadPreview.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.min.js') }} "></script>
    <!-- Data trable -->
    <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
      $(document).ready( function () {
        $('#myTable').DataTable();
      });
    </script>
    <script src="{{ asset('js/scripts.js') }} "></script>
    @yield('scripts')

</body>
</html>