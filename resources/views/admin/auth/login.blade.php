<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>云和管理平台</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue.css" id="theme"  rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register" style="background:url(/admin/plugins/images/login-register.jpg) no-repeat center center / cover!important;">
    <div class="login-box login-sidebar">
        <div class="white-box">
            <form action="{{ route('admin.login.post') }}" method="post" class="form-horizontal form-material" id="loginform" action="index.html">
                {{ csrf_field() }}

                <a href="javascript:void(0)" class="text-center db">
                    云和管理平台
                </a>

                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <input name="user_name" class="form-control" type="text" required="" placeholder="用户名">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="password" class="form-control" type="password" required="" placeholder="密码">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-primary pull-left p-t-0">
                            <input name="remember" value="true" id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup"> 记住密码 </label>
                        </div>
                    </div>
                </div>

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit"> 登录 </button>
                    </div>
                </div>
            </form>

        </div>

        @include('admin.common._error')

    </div>
</section>

<!-- jQuery -->
<script src="/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="/admin/bootstrap/dist/js/bootstrap.min.js"></script>
<!--Wave Effects -->
<script src="/admin/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="/admin/js/custom.min.js"></script>
</body>
</html>
