<?php

namespace App\Http\Requests;

class ProductRequest extends Request
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
                        'category_id' => 'required|integer|exists:categories,id',
                        'discount' => 'numeric|max:100',
                        'intro' => 'string',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name' => 'required|string',
                        'category_id' => 'required|integer|exists:categories,id',
                        'discount' => 'numeric|max:100',
                        'intro' => 'string',
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
            'name.required' => '产品名称不能为空',
            'discount.max' => '折扣不能大于100',
            'category_id.exists' => '产品分类不存在',
        ];
    }
}
