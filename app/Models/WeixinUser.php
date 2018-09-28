<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Traits\WeixinAuthHelper;

class WeixinUser extends Authenticatable
{
    use Notifiable;
    use WeixinAuthHelper;
    protected $fillable = ['nickname', 'openid', 'unionid', 'sex', 'province', 'city', 'country', 'headimgurl', 'privilege'];


}
