@extends('member.layouts.member')

@section('title', '斯柏森会员中心')

@section('content')
    <div class="login_content">
        <div class="logobox">
            <img src="/member/images/logo.png" alt="">
        </div>
        <div class="formbox">
            <div class="row flex_align">
                <div class="label">手机号</div>
                <div class="ipt flex_1"><input type="tel" name="phone" maxlength="11"></div>
            </div>
            <div class="row flex_align">
                <div class="label">验证码</div>
                <div class="ipt flex_1"><input type="tel" name="code" maxlength="6"></div>
                <div class="get_code_box">
                    <div class="get_code_btn on" onclick="getCode()">获取验证码</div>
                </div>
            </div>
            <div class="ok_btn" onclick="submit()">GO</div>
        </div>
        <div class="sign">斯柏森（SPACE）高端锻造轮毂</div>
    </div>
@endsection

@section('script')
    <script>
        var second = 3;

        var canGetCode = true,
            s = second,
            timer;

        function submit() {
            var code = $('input[name="code"]').val();

            if (code == '') {
                lyup.msg('验证码不能为空');
                return false;
            }

            //提交验证ajax
            $.post(
                "/member/weixin_users/{{ $weixinUser->id }}/members",
                {phone: $('input[name="phone"]').val(), code: $('input[name="code"]').val(), _token: $('meta[name="csrf-token"]').attr('content')},
                function (data) {
                    if(data.status == 'error') {
                        lyup.msg(data.message);
                        return false;
                    } else if(data.status == 'success') {
                        if(data.data.member.employee_id == 0) {
                            window.location.href = "/member/edit_employee";
                        } else {
                            window.location.href = "{{ route('member.center') }}";
                        }
                        return true;
                    } else {
                        lyup.msg('发生错误，请稍后重试');
                        return false;
                    }
                }
            );

            //提交表单
            console.log('提交成功');
        }

        function getCode() {
            if (!validate()) return false;
            if (!canGetCode) return false;
            canGetCode = false;

            $('.get_code_btn').removeClass('on').text(s + 's后重新获取');

            timer = setInterval(function () {
                s--;
                if (s == 0) {
                    canGetCode = true;
                    s = second;
                    $('.get_code_btn').addClass('on').text('获取验证码');
                    clearInterval(timer);
                    return false;
                }
                $('.get_code_btn').text(s + 's后重新获取');
            }, 1000);

            //获取验证码ajax
            $.post(
                '/member/verification_codes',
                {phone: $('input[name="phone"]').val(), _token: $('meta[name="csrf-token"]').attr('content')},
                function (data) {
                    if(data.status == 'success') {
                        lyup.msg('验证码已发送，请注意查收');
                        return true;
                    } else {
                        lyup.msg('验证码发送失败，请重新尝试');
                        return false;
                    }
                }
            );
        }

        function validate() {
            var phone = $('input[name="phone"]').val();
            if (phone == '') {
                lyup.msg('手机号码不能为空');
                return false;
            } else if (!(/^1[34578]\d{9}$/.test(phone))) {
                lyup.msg('手机号码格式不正确');
                return false;
            }
            return true;
        }
    </script>
    @endsection

    </body>
    </html>