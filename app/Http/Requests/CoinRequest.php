<?php

namespace App\Http\Requests;

class CoinRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'number' => [
                            'required',
                            function ($attribute, $value, $fail) {
                                if ($value == 0) {
                                    return $fail('操作积分数量不能为0！');
                                }
                            }
                        ],
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
            'number.required' => '积分变动数量不能为空',
            'remark.required' => '备注信息不能为空',
        ];
    }
}
