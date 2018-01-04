<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset Password Agency</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/dist/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/iCheck/square/blue.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .forgot_form{
            display:none
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>Cnerr</b>(Agency)</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Reset your password</p>
        <form action="{{ route('resetAgencyPassword') }}" method="post">
            @if($errors->has('auth'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ $errors->first('auth') }}
                </div>
            @endif


            @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="alert alert-success" role="alert">{{ \Illuminate\Support\Facades\Session::get('success') }}</div>
                {{ \Illuminate\Support\Facades\Session::forget('success') }}
            @endif
            <div class="form-group<?= $errors->has('password') ? ' has-error' : '' ?> has-feedback">
                <input name="password" type="password" class="form-control" placeholder="New Password" value="{{ old('password') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group<?= $errors->has('password_confirmation') ? ' has-error' : '' ?> has-feedback">
                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if($errors->has('confirm_password'))
                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                @endif

            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="submit_passwords">
                    Reset
                </button>
            </div>
                <input type="hidden" value="{{ Request::segment(2) }}" name="email">
        </form>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('bower_components/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ asset('bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('bower_components/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>

</body>
</html>
