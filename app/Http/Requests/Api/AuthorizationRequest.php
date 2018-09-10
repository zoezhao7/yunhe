<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class AuthorizationRequest extends FormRequest
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
            'user_name' => 'required|string',
            'password' => 'required|string|min:4|max:20',
        ];
    }

    public function messages()
    {
        return [
          'user_name.required' => '用户名不能为空',
          'password.required' => '密码不能为空',
          'password.min' => '密码长度4到20位',
          'password.max' => '密码长度4到20位',
        ];
    }
}
