<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon_1.ico') }}">

        <title>Minton - Responsive Admin Dashboard Template</title>

        <link href="{{ asset('admin/plugins/switchery/switchery.min.css') }}" rel="stylesheet" />

        <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet" type="text/css">

        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>

    </head>
    <body>

        <div class="wrapper-page">

            <div class="text-center">
                <a href="#" class="logo-lg"><i class="mdi mdi-radar"></i> <span>Minton</span> </a>
            </div>

            <form class="form-horizontal m-t-20">

                <div class="form-group row">
                    <div class="col-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="mdi mdi-account"></i></span>
                            <input class="form-control" type="text" required="" placeholder="Username">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="mdi mdi-radar"></i></span>
                            <input class="form-control" type="password" required="" placeholder="Password">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup">
                                Remember me
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group text-right m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-custom w-md waves-effect waves-light" type="button">Log In
                        </button>
                    </div>
                </div>

                <div class="form-group row m-t-30">
                    <div class="col-sm-7">
                        <a href="#" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your
                            password?</a>
                    </div>
                    <div class="col-sm-5 text-right">
                        <a href="#" class="text-muted">Create an account</a>
                    </div>
                </div>
            </form>
        </div>


        <script>
            var resizefunc = [];
        </script>

        <!-- Plugins  -->
        <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/popper.min.js') }}"></script><!-- Popper for Bootstrap -->
        <script src="{{ asset('admin/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/detect.js') }}"></script>
        <script src="{{ asset('admin/assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('admin/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('admin/assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('admin/assets/js/waves.js') }}"></script>
        <script src="{{ asset('admin/assets/js/wow.min.js') }}"></script>
        <script src="{{ asset('admin/assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset('admin/assets/js/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/switchery/switchery.min.js') }}"></script>

        <!-- Custom main Js -->
        <script src="{{ asset('admin/assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('admin/assets/js/jquery.app.js') }}"></script>
	
	</body>
</html>