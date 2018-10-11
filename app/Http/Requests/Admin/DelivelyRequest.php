<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DelivelyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'delivered_at' => 'required|date',
            'delivery_number' => 'required|alpha_dash',
            'delivery_note' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'delivered_at.required' => '发货时间不能为空',
            'delivery_number.required' => '物流单号不能为空',
            'delivery_number.alpha_dash' => '请填写正确的物流单号',
            'delivered_at.date' => '发货时间格式错误',
        ];
    }
}
