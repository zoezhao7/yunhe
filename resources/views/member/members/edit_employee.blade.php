@extends('member.layouts.member')

@section('title', '绑定销售顾问')

@section('content')
    <div class="bind_content">
        <div class="pass">
            <a href="{{ route('member.center') }}">跳过</a>
        </div>
        <div class="formbox">
            <div class="row flex_align">
                <div class="label">手机号</div>
                <div class="ipt flex_1"><input type="tel" name="phone" maxlength="11" placeholder="请输入销售顾问的手机号码"></div>
            </div>
            <div class="ok_btn" onclick="submit()">绑定</div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function submit() {
            if (!validate()) return false;

            //提交验证ajax
            $.post(
                "/member/update_employee",
                {
                    phone: $('input[name="phone"]').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
            ).success(function (data) {
                if (data.status == 'error' || data.errors) {
                    lyup.msg(data.message);
                    return false;
                } else if (data.status == 'success') {
                    lyup.msg('绑定成功，进入会员中心...');
                    setTimeout(window.location.href = "/member/center", '1000');
                    return true;
                } else {
                    lyup.msg('服务器异常');
                    return false;
                }
            }).error(function (xhr) {
                if (xhr.status == 422) {
                    lyup.msg('参数错误，请重新尝试');
                } else {
                    lyup.msg('服务器异常' + xhr.status);
                }
                return false;
            });

            //提交表单
            console.log('提交成功');
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