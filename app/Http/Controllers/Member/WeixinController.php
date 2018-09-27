<?php
/**
 * Created by PhpStorm.
 * User: DC
 * Date: 2018/9/27
 * Time: 17:00
 */

namespace App\Handlers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class WeixinController
{
    protected $guzzleOptions = [];
    protected $redirectUrl = '';
    protected $appId = '';
    protected $secret = '';

    public function __construct()
    {
        $this->appId = config('services.weixin.app_id');
        $this->secret = config('services.weixin.secret');
    }

    public function login(Request $request)
    {
        // 微信认证流程
        if(!$request->has('code') || $request->code) {
            $this->redirectAuthorize();
        }
        $tokenResult = $this->getToken($request->code);
        $userInfo = $this->getUserInfo($tokenResult['access_token'], $tokenResult['open_id']);

        // 客户登录
        $member = Member::where('weixin_unionid', $userInfo['unionid'])->first();
        if($member) {
            #login流程
            return redirect()->route('member.center');
        } else {
            #添加微信用户信息
            #登录流程
            #跳转到绑定销售顾问手机号界面
        }
    }

    public function redirectAuthorize()
    {
        return redirect()->to($this->authorizeUrl());
    }

    public function getToken($code)
    {
        return $this->getHttpClient()->get($this->tokenUrl($code))->getBody()->getContents();
    }

    public function getUserInfo($token, $openid)
    {
        return $this->getHttpClient()->get($this->infoUrl($token, $openid))->getBody()->getContents();
    }

    public function authorizeUrl()
    {
        $appId = $this->appId;
        return 'https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appId}&redirect_uri={$redirectUrl}&response_type=code&scope=SCOPE&state=STATE#wechat_redirect';
    }

    public function tokenUrl($code)
    {
        $appId = $this->appId;
        $secret = $this->secret;
        return 'https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appId}&secret={$secret}&code={$code}grant_type=authorization_code';
    }

    public function infoUrl($token, $openid)
    {
        return 'https://api.weixin.qq.com/sns/userinfo?access_token={$token}&openid={$openid}&lang=zh_CN';
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setHttpClient(array $options)
    {
        $this->guzzleOptions = $options;
    }

}