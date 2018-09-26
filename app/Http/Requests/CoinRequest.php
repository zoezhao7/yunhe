<?php

namespace App\Http\Requests;

class CoinRequest extends Request
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
                    'number' => 'required|numeric',
                    'remark' => 'required|string',
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
            'remark:required' => '备注信息不能为空',
        ];
    }
}
