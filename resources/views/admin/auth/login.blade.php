<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>后台管理</title>
    <link rel="shortcut icon" href="{{ asset('vendor/admin/assets/images/favicon_1.ico') }}">
    <link href="{{ asset('vendor/admin/plugins/switchery/switchery.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('vendor/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/admin/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/admin/assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('vendor/admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/layer/layer.js') }}"></script>
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
                    <input id="account" class="form-control" type="text" required="" placeholder="Admin">
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="mdi mdi-radar"></i></span>
                    <input id="password" class="form-control" type="password" required="" placeholder="Password">
                </div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12">
                <div class="checkbox checkbox-primary">
                    <input id="checkbox-signup" type="checkbox">
                </div>
            </div>
        </div>

        <div class="form-group text-right m-t-20">
            <div class="col-xs-12" style="padding: 0">
                <a href="#" class="text-muted pull-left"><i class="fa fa-lock m-r-5"></i>忘记密码</a>
                <button onclick="login()" class="btn btn-primary btn-custom w-md waves-effect waves-light"
                        type="button">登录
                </button>
            </div>
        </div>

    </form>
</div>

<script>
    function login() {
        $.ajax({
            url: '/admin/login',
            type: 'post',
            dataType: 'json',
            data: {
                'account': $('#account').val(),
                'password': $('#password').val()
            },
            success: function (res) {
                console.log(res)
            }
        })
    }
</script>

</body>
</html>