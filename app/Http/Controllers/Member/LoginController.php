<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use App\Models\WeixinUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request, WeixinUser $weixinUser)
    {
        $weixinUser->setAuthConfig();

        // 获取微信用户信息
        if (!$request->has('code') || !$request->code) {
            return redirect()->to($weixinUser->authorizeUrl(route('member.login')));
        }
        $userInfo = $weixinUser->getInfo($request->code);

        // 登陆验证
        if ($this->guard()->attempt(['weixin_openid' => $userInfo['openid']])) {
            return redirect()->route('member.center');
        }

        // 保存微信用户数据
        $weixinUser = WeixinUser::firstOrCreate(
            ['openid' => $userInfo['openid']],
            [
                'openid' => $userInfo['openid'],
                'nickname' => $userInfo['nickname'],
                'sex' => $userInfo['sex'],
                'province' => $userInfo['province'],
                'city' => $userInfo['city'],
                'country' => $userInfo['country'],
                'headimgurl' => $userInfo['headimgurl'],
                'privilege' => empty($userInfo['privilege']) ? '' : json_encode($userInfo['privilege']),
                'unionid' => isset($userInfo['unionid\'']) ? $userInfo['unionid\''] : '',
            ]
        );

        // 跳转到创建用户页面（手机号）
        return redirect()->route('member.members.create', $weixinUser);

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
