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
<body>
    <div id="app">
        

            @include('common.notify')
            @yield('content')


        
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

    <script src='https://www.google.com/recaptcha/api.js'></script>
    


    @yield('scripts')

</body>
</html>