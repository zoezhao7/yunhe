<?php
/**
 * Created by PhpStorm.
 * User: zoe
 * Date: 2018/9/27
 * Time: 21:58
 */
namespace App\Models\Traits;
use Illuminate\Http\Request;
use GuzzleHttp\Client;


trait WeixinAuthHelper{

    protected $guzzleOptions = [];

    protected $appId = '';
    protected $secret = '';

/*    public function __construct()
    {
        parent::__construct();
        $this->appId = config('services.weixin.app_id');
        $this->secret = config('services.weixin.secret');
    }*/

    public function setAuthConfig()
    {
        $this->appId = config('services.weixin.app_id');
        $this->secret = config('services.weixin.secret');
    }

    public function getInfo($code)
    {
        $tokenResult = $this->getToken($code);
        $tokenResult = json_decode($tokenResult, true);
        $userInfo = $this->getUserInfo($tokenResult['access_token'], $tokenResult['openid']);
        return json_decode($userInfo, true);

    }

    public function getToken($code)
    {
        return $this->getHttpClient()->get($this->tokenUrl($code))->getBody()->getContents();
    }

    public function getUserInfo($token, $openid)
    {
        return $this->getHttpClient()->get($this->infoUrl($token, $openid))->getBody()->getContents();
    }

    public function authorizeUrl($redirectUrl)
    {
        $appId = $this->appId;
        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appId}&redirect_uri={$redirectUrl}&response_type=code&scope=snsapi_userinfo#wechat_redirect";
    }

    public function tokenUrl($code)
    {
        $appId = $this->appId;
        $secret = $this->secret;
        return "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appId}&secret={$secret}&code={$code}&grant_type=authorization_code";
    }

    public function infoUrl($token, $openid)
    {
        return "https://api.weixin.qq.com/sns/userinfo?access_token={$token}&openid={$openid}&lang=zh_CN";
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