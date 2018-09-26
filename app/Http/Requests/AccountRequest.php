<?php

namespace App\Http\Requests;

class AccountRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'money' => 'required|numeric',
                    'type' => 'required|in:1,2',
                    'channel' => 'required|string',
                    'operated_at' => 'required|date|before_or_equal:'.now(),
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
            'money.required' => '金额不能为空',
            'type.required' => '收支类型不能为空',
            'channel.required' => '账务类型不能为空',
            'operated_at.required' => '账务时间不能为空',
            'operated_at.before_or_equal' => '账务时间不能大于今天！',
        ];
    }
}
