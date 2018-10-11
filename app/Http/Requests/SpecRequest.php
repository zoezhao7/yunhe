<?php

namespace App\Http\Requests;

class SpecRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
                {
                    return [
                        'idnumber' => 'required|string|unique:specs,idnumber',
                        'size' => 'required|string',
                        'price' => 'required|numeric',
                        'content' => 'array',
                    ];
                }
            case 'PUT':
            case 'PATCH':
            {
                $id = $this->route('spec')->id;
                return [
                    'idnumber' => 'required|string|unique:specs,idnumber,' . $id,
                    'size' => 'required|string',
                    'price' => 'required|numeric',
                    'content' => 'array',
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
            'idnumber.required' => '型号ID不能为空',
            'idnumber.unique' => '型号ID已存在，请更正',
            'size.required' => '尺寸不能为空',
            'price.required' => '价格不能为空',
            'price.numeric' => '价格填写错误',
        ];
    }
}
