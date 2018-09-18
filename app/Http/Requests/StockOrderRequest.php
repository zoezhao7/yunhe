<?php

namespace App\Http\Requests;

class StockOrderRequest extends Request
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
                    'product_id' => 'required|integer',
                    'spec_id' => 'required|integer',
                    'color' => 'required|string',
                    'number' => 'required|integer',
                    'remark' => 'nullable|string',
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
            'spec_id.required' => '请选择产品规格',
            'color.required' => '请选择产品颜色',
            'number.required' => '请填写进货数量（套）',
        ];
    }
}
