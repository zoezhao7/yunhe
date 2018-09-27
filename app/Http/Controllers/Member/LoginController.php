<?php

namespace App\Http\Controllers\Member;

use App\Models\WeixinUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request, WeixinUser $weixinUser)
    {
        // 获取微信用户信息
        if (!$request->has('code') || !$request->code) {
            return redirect()->to($weixinUser->authorizeUrl(route('member.login')));
        }
        $userInfo = $weixinUser->getInfo($request->code);

        // 登陆验证
        if ($this->guard()->attempt(['weixin_openid' => $userInfo['openid']])) {
            return redirect()->route('member.center');
        }

        // 无账户时，加载账户创建页面
        return view('member.members.create');

    }

    public function attempt(array $credentials = [], $remember = false)
    {
        $this->lastAttempted = $user = $this->provider->retrieveByCredentials($credentials);

        $this->login($user, $remember);

        return true;
    }

    // 定义用户名字段
    public function username()
    {
        return 'unionid';
    }

    // 定义守护器
    protected function guard()
    {
        return \Auth::guard('member');
    }

}
