<?php
/**
 * Created by PhpStorm.
 * User: DC
 * Date: 2018/9/29
 * Time: 14:59
 */

namespace App\Extensions;


use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class EloquentMemberProvider extends  EloquentUserProvider
{
    public function validateCredentials(UserContract $user, array $credentials)
    {
        return true;
    }
}