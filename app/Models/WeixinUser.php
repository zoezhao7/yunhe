<?php

namespace App\Models;

use App\Models\Traits\WeixinAuthHelper;
use Illuminate\Database\Eloquent\Model;

class WeixinUser extends Model
{
    use WeixinAuthHelper;

    protected $fillable = ['openid', 'unionid', 'nickname', 'sex', 'province', 'city', 'country', 'headimgurl', 'privilege'];
}
