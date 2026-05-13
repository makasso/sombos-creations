<!DOCTYPE html><!--[if IE 8 ]>
<html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US"
      lang="en-US"> <![endif]--><!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>
    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>{{ config('app.name') }} - Admin @yield('title')</title>

    <meta name="author" content="mEKF1379TjMP.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/animation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/styles.css')}}">


    <link rel="stylesheet" href="{{ asset('admin/font/fonts.css')}}">

    <!-- Icon -->
    <link rel="stylesheet" href="{{ asset('admin/icon/style.css')}}">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/logo/favicon.png')}}">


    <style>
        input[type="file"] {
            cursor: pointer;
        }

        .gallery-wrap .item {
            position: relative;
        }

        .gallery-wrap .delete-button {
            position: absolute;
            top: 0;
            right: 0;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            padding: 8px 8px !important;
        }


    </style>


</head>

<body>

<!-- #wrapper -->
<div id="wrapper">
    <!-- #page -->
    <div id="page" class="">
        <!-- layout-wrap -->
        <div class="layout-wrap">

            <!-- section-menu-left -->
            @include('admin.partials.menu-left')
            <!-- /section-menu-left -->
            <!-- section-content-right -->
            <div class="section-content-right">
                <!-- header-dashboard -->
                @include('admin.partials.header')
                <!-- /header-dashboard -->
                <!-- main-content -->
                <div class="main-content">
                    @yield('content')
                    <div class="bottom-page">
                        <div class="body-text">Copyright © {{ date('Y') }} <a
                                href="{{ route('home') }}">{{ config('app.name') }}</a>. Design by
                            <a href="https://maatonggroup.com/usa" target="_blank">MaatongTech USA LLC</a> All rights
                            reserved
                        </div>
                    </div>
                </div>

                <!-- /main-content -->
            </div>
            <!-- /section-content-right -->
        </div>
        <!-- /layout-wrap -->
    </div>
    <!-- /#page -->
</div>
<!-- /#wrapper -->

<!-- Javascript -->
<script src="{{ asset('admin/js/jquery.min.js')}}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('admin/js/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('admin/js/zoom.js')}}"></script>
<script src="{{ asset('admin/js/morris.min.js')}}"></script>
<script src="{{ asset('admin/js/raphael.min.js')}}"></script>
{{--<script src="{{ asset('admin/js/morris.js')}}"></script>--}}
<script src="{{ asset('admin/js/jvectormap.min.js')}}"></script>
<script src="{{ asset('admin/js/jvectormap-us-lcc.js')}}"></script>
<script src="{{ asset('admin/js/jvectormap-data.js')}}"></script>
<script src="{{ asset('admin/js/jvectormap.js')}}"></script>
<script src="{{ asset('admin/js/apexcharts/apexcharts.js')}}"></script>
<script src="{{ asset('admin/js/apexcharts/line-chart-1.js')}}"></script>
<script src="{{ asset('admin/js/apexcharts/line-chart-2.js')}}"></script>
<script src="{{ asset('admin/js/apexcharts/line-chart-3.js')}}"></script>
<script src="{{ asset('admin/js/apexcharts/line-chart-4.js')}}"></script>
<script src="{{ asset('admin/js/apexcharts/line-chart-5.js')}}"></script>
<script src="{{ asset('admin/js/apexcharts/line-chart-6.js')}}"></script>
<script src="{{ asset('admin/js/apexcharts/line-chart-7.js')}}"></script>
<script src="{{ asset('admin/js/theme-settings.js') }}"></script>

<script src="{{ asset('admin/js/main.js') }}"></script>
@include('sweetalert::alert')
@stack('scripts')
</body>
</html>
