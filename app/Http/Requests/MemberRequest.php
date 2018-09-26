<?php

namespace App\Http\Requests;

class MemberRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|string',
                    'phone' => 'required|string',
                    'employee_id' => 'required|exists:employees,id',
                ];
            }
            case 'GET':
            case 'DELETE':
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
            'phone.required' => '电话号码不能为空',
            'employee_id.required' => '所属销售必须选择',
            'employee_id.exists' => '所属销售必须选择',
        ];
    }
}
