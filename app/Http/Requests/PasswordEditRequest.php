<?php
/**
 * Created by PhpStorm.
 * User: DC
 * Date: 2018/10/3
 * Time: 22:08
 */

namespace App\Http\Requests;


class PasswordEditRequest extends Request
{
    public function rules()
    {
        return [
          'old_password' => 'required|string|min:6|max:20',
          'password' => 'required|string|min:6|max:20|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => '原密码不能为空',
            'password.required' => '新密码未填写',
            'password.min' => '密码最短4位',
            'password.max' => '密码最长20位',
            'password.confirmed' => '请重复输入正确的新密码',
        ];
    }
}