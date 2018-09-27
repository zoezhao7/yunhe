<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MembersController extends Controller
{
    public function center()
    {
        if (!\Auth::guard('member')->check()) {
            return redirect()->to(route('weixin.login'));
        }

        dd('this is member center');
    }

    public function demo()
    {
        #获取微信用户信息
        #已绑定-》登录-》进入Center
        #未绑定-》保存微信用户信息-》跳转到绑定页面-》完成/跳过绑定-》进入Center
    }

    public function store(MemberRequest $request)
    {
        $phone = $request->phone;
        $code = $request->code;
        $verificationKey = 'verificationCode_' . $phone;

        // 验证码失效
        if (!session()->has($verificationKey)) {
            return response(['status' => 'error', 'message' => '验证码已失效，请重新发送']);
        }

        // 验证码错误
        $verifyData = session($verificationKey);
        if (!hash_equals($verifyData['code'], $code)) {
            return response(['status' => 'error', 'message' => '验证码错误']);
        }

        $member = Member::where('phone', $phone)->first();

        if (!$member) {
            $member = Member::create([
                'employee_id' => 0,
                'name' => '',
                'phone' => $phone,
                'weixin_openid' => '',
                'weixin_unionid' => '',
            ]);
        }

        session()->forget($verificationKey);

        return response(['status' => 'success', 'data' => ['member' => $member->toArray()]]);
    }
}
