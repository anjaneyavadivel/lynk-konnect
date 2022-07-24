
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    
    <title>{{ config('app.name', 'Lynk Konnect') }}</title>
    
    <link rel="apple-touch-icon" href="{{ asset('assets/images/apple-touch-icon.png') }}">
    <!-- <link rel="shortcut icon" href="{{ asset('temp/assets/images/favicon.ico') }}"> -->
    <link rel="shortcut icon" href="{{ asset('temp/assets/images/favicon.png') }}">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('temp/global/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/css/bootstrap-extend.min.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/assets/css/site.min.css') }}">
    
    <!-- Plugins -->
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/animsition/animsition.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/asscrollable/asScrollable.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/switchery/switchery.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/intro-js/introjs.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/slidepanel/slidePanel.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/flag-icon-css/flag-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/waves/waves.css') }}">
        <!-- Dashboard -->
        <link rel="stylesheet" href="{{ asset('temp/global/vendor/chartist/chartist.css') }}">
        <link rel="stylesheet" href="{{ asset('temp/global/vendor/jvectormap/jquery-jvectormap.css') }}">
        <link rel="stylesheet" href="{{ asset('temp/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}">
        <link rel="stylesheet" href="{{ asset('temp/assets/examples/css/dashboard/v1.css') }}">
        <!-- Datatable -->
        <link rel="stylesheet" href="{{ asset('temp/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('temp/global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('temp/global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('temp/global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('temp/global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('temp/global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('temp/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('temp/global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css') }}">
        <link rel="stylesheet" href="{{ asset('temp/assets/examples/css/tables/datatable.css') }}">
 

        <!-- Form -->
        <link rel="stylesheet" href="{{ asset('temp/assets/examples/css/forms/layouts.css') }}">

        <link rel="stylesheet" href="{{ asset('temp/global/fonts/glyphicons/glyphicons.css') }}">
        <!-- File uploads -->
        <link rel="stylesheet" href="{{ asset('temp/global/vendor/blueimp-file-upload/jquery.fileupload.css') }}">
        <link rel="stylesheet" href="{{ asset('temp/global/vendor/dropify/dropify.css') }}">
    
    
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('temp/global/fonts/material-design/material-design.min.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/fonts/brand-icons/brand-icons.min.css') }}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


    <link rel="stylesheet" href="{{ asset('temp/global/vendor/timepicker/jquery-timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}">

    
    <!--[if lt IE 9]>
    <script src="../../global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
    
    <!--[if lt IE 10]>
    <script src="../../global/vendor/media-match/media.match.min.js"></script>
    <script src="../../global/vendor/respond/respond.min.js"></script>
    <![endif]-->
    
    <!-- Scripts -->
    <script src="{{ asset('temp/global/vendor/breakpoints/breakpoints.js') }}"></script>
    <script>
      Breakpoints();
    </script>
  </head>
  <body class="animsition dashboard">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    @yield('content')
    
  </body>
</html>
