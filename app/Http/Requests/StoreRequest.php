<?php

namespace App\Http\Requests;

class StoreRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|string',
                    'phone' => 'required|string',
                    'address' => 'required|string',
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
            'name.required' => '门店名称不能为空',
            'phone.required' => '联系电话不能为空',
            'address.required' => '门店地址不能为空',
        ];
    }
}
