<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Meta Responsive tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!--Custom style.css-->
    <link rel="stylesheet" href="{{ asset('assets/css/quicksand.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!--Font Awesome-->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <!--Animate CSS-->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <!--Chartist CSS-->
    <link rel="stylesheet" href="{{ asset('assets/css/chartist.min.css') }}">
    <!--Morris Css-->
    <link rel="stylesheet" href="{{ asset('assets/css/morris.css') }}">
    <!--Map-->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-jvectormap-2.0.2.css') }}">
    <!--Bootstrap Calendar-->
    <link rel="stylesheet" href="{{ asset('assets/js/calendar/bootstrap_calendar.css') }}">
    <!--Nice select -->
    <link rel="stylesheet" href="{{ asset('assets/css/nice-select.css') }}">

    <!--Datatable-->
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">

    {{--    Css Admin--}}
    <link rel="stylesheet" href="{{ asset('assets/css/write_Your.css') }}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title>Hệ thống giám sát ao nuôi</title>
</head>
<body>
<!--Page loader-->
<div class="loader-wrapper">
    <div class="loader-circle">
        <div class="loader-wave"></div>
    </div>
</div>
<!--Page loader-->

<!--Page Wrapper-->

<div class="container-fluid">

    <!--Header-->

    <!--Header-->
@include('layout/headerUser')
<!--Main Content-->

    <div class="row main-content">
        <!--Sidebar left-->
    @include('layout/sidebar_menuUser')
    <!--Sidebar left-->

        <!--Content right-->
        @yield('content')
    </div>

    <!--Main Content-->

</div>

</body>
<!--Page Wrapper-->
<!-- Page JavaScript Files-->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
<!--Popper JS-->
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<!--Bootstrap-->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!--Sweet alert JS-->
<script src="{{ asset('assets/js/sweetalert.js') }}"></script>
<!--Progressbar JS-->
<script src="{{ asset('assets/js/progressbar.min.js') }}"></script>
<!--Flot.JS-->
<script src="{{ asset('assets/js/charts/jquery.flot.min.js') }}"></script>
<script src="{{ asset('assets/js/charts/jquery.flot.pie.min.js') }}"></script>
<script src="{{ asset('assets/js/charts/jquery.flot.categories.min.js') }}"></script>
<script src="{{ asset('assets/js/charts/jquery.flot.stack.min.js') }}"></script>
<!--Sparkline-->
<script src="{{ asset('assets/js/charts/sparkline.min.js') }}"></script>
<!--Morris.JS-->
<script src="{{ asset('assets/js/charts/raphael.min.js') }}"></script>
<script src="{{ asset('assets/js/charts/morris.js') }}"></script>
<!--Chart JS-->
<script src="{{ asset('assets/js/charts/chart.min.js') }}"></script>
<!--Chartist JS-->
<script src="{{ asset('assets/js/charts/chartist.min.js') }}"></script>
<script src="{{ asset('assets/js/charts/chartist-data.js') }}"></script>
<script src="{{ asset('assets/js/charts/demo.js') }}"></script>
<!--Maps-->
<script src="{{ asset('assets/js/maps/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/js/maps/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('assets/js/maps/jvector-maps.js') }}"></script>
<!--Bootstrap Calendar JS-->
<script src="{{ asset('assets/js/calendar/bootstrap_calendar.js') }}"></script>
<script src="{{ asset('assets/js/calendar/demo.js') }}"></script>
<!--Nice select-->
<script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>

<!--Custom Js Script-->
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!--Canvas JS-->
<script src="{{ asset('assets/js/charts/canvas.min.js') }}"></script>

<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

<!--Nice select-->
<script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>

<script>
    //Order list dataTable
    $("#productList").DataTable();
    //Nice select
    $('.bulk-actions').niceSelect();
</script>
@stack('additionalJS')

</html>
