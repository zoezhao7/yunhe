<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>云和管理平台</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
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
<section id="wrapper" class="login-register"
         style="background:url(/admin/plugins/images/login-register.jpg) no-repeat center center / cover!important;">
    <div class="login-box login-sidebar">
        <div class="white-box">
            <form action="{{ route('admin.login.post') }}" method="post" class="form-horizontal form-material">
                <a href="javascript:void(0)" class="text-center db">
                    云和管理平台
                </a>

                <div class="form-group m-t-40">
                    <div class="col-xs-12">
                        <input name="phone" class="form-control" type="text" required="" placeholder="手机号码">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="password" class="form-control" type="password" required="" placeholder="密码">
                    </div>
                </div>

                <div class="input-group m-b-20">
                    <input type="text" id="code" name="code" class="form-control"
                           placeholder="短信验证码" autocomplete="off">
                    <span class="input-group-btn">
                        <button onclick="sendCode();" type="button"
                                class="get_code_btn btn waves-effect waves-light btn-info">发送验证码</button>
                     </span>
                </div>


{{--                <div class="form-group">
                    <div class="col-md-12">
                        <div class="checkbox checkbox-primary pull-left p-t-0">
                            <input name="remember" value="true" id="checkbox-signup" type="checkbox">
                            <label for="checkbox-signup"> 记住密码 </label>
                        </div>
                    </div>
                </div>--}}

                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button type="button" onclick="loginSubmit();" id="btn_submit"
                                class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"> 登录
                        </button>
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
<script src="/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<script src="/admin/js/custom.min.js"></script>
<script src="/admin/js/jquery.slimscroll.js"></script>
<script src="/admin/plugins/bower_components/sweetalert/sweetalert.min.js"></script>

<script>

    var second = 30;
    var canGetCode = true,
        s = second,
        timer;

    //发送短信验证码
    function sendCode() {
        if (!validate()) return false;
        if (!canGetCode) return false;
        canGetCode = false;

        var phone = $('input[name="phone"]').val();
        $('.get_code_btn').prop('disabled', true).text(s + 's后重新获取');

        timer = setInterval(function () {
            s--;
            if (s == 0) {
                canGetCode = true;
                s = second;
                $('.get_code_btn').prop('disabled', false).text('获取验证码');
                clearInterval(timer);
                return false;
            }
            $('.get_code_btn').text(s + 's后重新获取');
        }, 1000);

        //获取验证码ajax
        $.post(
            '/member/verification_codes',
            {phone: phone, _token: $('meta[name="csrf-token"]').attr('content')},
            function (data) {
                if (data.status == 'success') {
                    swal('验证码已发送，请注意查收', '', 'success');
                    return true;
                } else {
                    swal('验证码发送失败，请重新尝试', '', 'error');
                    return false;
                }
            }
        );
    }

    // 提交登录
    function loginSubmit() {

        if(!validateSubmit()) return false;

        $('#btn_submit').prop('disabled', true).text('登录验证中...');

        var code = $('input[name="code"]').val();
        var phone = $('input[name="phone"]').val();
        var _token = $('meta[name="csrf-token"]').attr('content');
        var password = $('input[name="password"]').val();

        if (code == '') {
            swal('验证码不能为空');
            return false;
        }

        $.ajax({
            type: "POST",
            url: "{{ route('admin.login') }}",
            data: {phone: phone, code: code, _token: _token, password: password},
            dataType: 'json',
            success: function (data) {
                if(data.success) {
                    swal({
                        title: '登录成功',
                        text: '',
                        type: 'success',
                        showCancelButton: false,
                        showConfirmButton: false,
                    });
                    window.location.href = "{{ route('admin.welcome') }}";
                    return true;
                } else {
                    swal(data.message, '', 'error');
                    $('#btn_submit').prop('disabled', false).text('登录');
                    return false;
                }
            },
            error: function (msg) {
                $('#btn_submit').prop('disabled', false).text('登录');
                if (msg.status == 422) {
                    var json = JSON.parse(msg.responseText);
                    json = json.errors;
                    for (var item in json) {
                        for (var i = 0; i < json[item].length; i++) {
                            swal(json[item][i], '', 'error');
                            return false; //遇到验证错误，就退出
                        }
                    }
                } else {
                    swal('服务器异常', '', 'error');
                    return false;
                }
            }
        });
    }

    function validate() {
        var phone = $('input[name="phone"]').val();
        if (phone == '') {
            swal('手机号码不能为空', '', 'error');
            return false;
        } else if (!(/^1[345789]\d{9}$/.test(phone))) {
            swal('手机号码格式不正确', '', 'error');
            return false;
        }
        return true;
    }

    function validateSubmit() {
        var phone = $('input[name="phone"]').val();
        var password = $('input[name="password"]').val();
        var code = $('input[name="code"]').val();

        if (phone == '') {
            swal('手机号码不能为空', '', 'error');
            return false;
        } else if (!(/^1[345789]\d{9}$/.test(phone))) {
            swal('手机号码格式不正确', '', 'error');
            return false;
        } else if (password == '') {
            swal('密码不能为空', '', 'error');
            return false;
        } else if (code == '') {
            swal('验证码不能为空', '', 'error');
            return false;
        }  else if (!(/^\d{4}$/.test(code))) {
            swal('验证码错误', '', 'error');
            return false;
        }

        return true;
    }

</script>

</body>
</html>
