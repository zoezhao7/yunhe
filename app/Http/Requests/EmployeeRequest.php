<?php

namespace App\Http\Requests;

class EmployeeRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        'name' => 'required|string',
                        'password' => 'required|string|min:6|max:20',
                        'store_id' => 'required|integer|exists:stores,id',
                        'phone' => 'required|string|regex:/^1[0-9]{10}$/|unique:employees,phone',
                        'type' => 'required|int',
                        'status' => 'required|int',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                $id = $this->route('employee')->id;
                {
                    return [
                        'name' => 'required|string',
                        'password' => 'string|min:6|max:20',
                        'store_id' => 'required|integer|exists:stores,id',
                        'phone' => 'required|string|regex:/^1[0-9]{10}$/|unique:employees,phone,' . $id,
                        'type' => 'required|int',
                        'status' => 'required|int',
                    ];
                }
            default:
                {
                    return [];
                };
        }
    }

    public function messages()
    {
        return [
            'name.required' => '姓名不能为空',
            'store_id.required' => '必须选择员工归属门店',
            'type.required' => '员工身份必须选择',
            'phone.required' => '手机号码格式错误',
            'phone.regex' => '手机号码格式错误',
            'phone.unique' => '手机号码已存在',
            'password.required' => '密码不能为空',
            'password.min' => '密码 6 - 20 位',
            'password.max' => '密码 6 - 20 位',
        ];
    }
}
