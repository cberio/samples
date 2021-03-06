<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat Samples > @yield('title')</title>
    <!-- Bootstrap 3.3.6 -->
    <link type="text/css" rel="stylesheet" href="/library/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css" />

    <!-- Theme style -->
    <link rel="stylesheet" href="/library/AdminLTE/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/library/AdminLTE/dist/css/skins/skin-red-light.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/library/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 2.2.3 -->
    <script src="/library/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="/library/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/library/AdminLTE/dist/js/adminlte.min.js"></script>

    <!-- select2 -->
    <link rel="stylesheet" href="/library/AdminLTE/bower_components/select2/dist/css/select2.min.css">
    <script src="/library/AdminLTE/bower_components/select2/dist/js/select2.min.js"></script>
</head>
<body class="hold-transition skin-red-light sidebar-mini">
    <div class="wrapper">
        @include('layouts.header')
        @include('layouts.aside')

        @yield('contents')

        @include('layouts.footer')
    </div>
</body>
@yield('scripts')
</html>
