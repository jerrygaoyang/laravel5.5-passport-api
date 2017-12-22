<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('vendor/admin/assets/images/favicon_1.ico') }}">

    <title>后台管理</title>

    <link href="{{ asset('vendor/admin/plugins/switchery/switchery.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('vendor/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/admin/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/admin/assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('vendor/admin/assets/js/modernizr.min.js') }}"></script>
</head>


<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">

    @include('admin.layouts.header')

    @include('admin.layouts.menu')

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            @yield('content')
        </div>
        <!-- end content -->
    </div>

    @include('admin.layouts.footer')
</div>
<!-- END wrapper -->

<!-- Plugins  -->
<script src="{{ asset('vendor/admin/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/admin/assets/js/popper.min.js') }}"></script><!-- Popper for Bootstrap -->
<script src="{{ asset('vendor/admin/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/admin/assets/js/detect.js') }}"></script>
<script src="{{ asset('vendor/admin/assets/js/fastclick.js') }}"></script>
<script src="{{ asset('vendor/admin/assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('vendor/admin/assets/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('vendor/admin/assets/js/waves.js') }}"></script>
<script src="{{ asset('vendor/admin/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('vendor/admin/assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('vendor/admin/assets/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('vendor/admin/plugins/switchery/switchery.min.js') }}"></script>

<!-- layer -->
<script src="{{ asset('vendor/layer/layer.js') }}"></script>

<!-- Custom main Js -->
<script src="{{ asset('vendor/admin/assets/js/jquery.core.js') }}"></script>
<script src="{{ asset('vendor/admin/assets/js/jquery.app.js') }}"></script>


<script>
    var resizefunc = [];
</script>

@yield('script')

</body>
</html>