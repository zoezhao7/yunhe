<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|min:4|max:20',
            'new_password' => 'required|min:4|max:20',
            'repeat_password' => 'required|same:new_password',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => '必须输入原密码',
            'new_password.required' => '必须输入新密码',
            'repeat_password.required' => '必须重复密码',
            'repeat_password.same' => '两次密码输入不一致',
        ];
    }
}
