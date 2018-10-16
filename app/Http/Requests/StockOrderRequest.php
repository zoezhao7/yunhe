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
                    'numbers' => 'required|array',
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
        ];
    }
}
