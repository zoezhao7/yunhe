<?php
/**
 * Created by PhpStorm.
 * User: DC
 * Date: 2018/9/27
 * Time: 17:00
 */

namespace App\Handlers;

use GuzzleHttp\Client;


class WeixinAuthHandler
{
    protected $guzzleOptions = [];
    protected $redirectUrl = '';
    protected $authUrl = '';
    protected $tokenUrl = '';
    protected $infoUrl = '';

    public function login()
    {

    }

    public function getAuthorize()
    {
        return redirect()->to($this->authUrl());
    }

    public function getToken($code)
    {
        return $this->getHttpClient()->get($this->tokenUrl(), ['code' => $code])->getBody()->getContents();
    }

    public function getUserInfo($token, $openid)
    {
        return $this->getHttpClient()->get($this->infoUrl(), ['access_token' => $token, 'openid' => $openid])->getBody()->getContents();
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