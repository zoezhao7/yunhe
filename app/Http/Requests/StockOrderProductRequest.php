<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockOrderProductRequest extends FormRequest
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
            'product_id' => 'int',
            'spec_id' => 'required|int',
            'color' => 'required|string',
            'number' => [
                'required',
                'int',
                function ($attribute, $value, $fail) {
                    if($value <= 0) {
                        return $fail('轮毂备货数量必须大于0！');
                    }
                }
            ],
            'car_vehicle_id' => 'required|integer',
            'remark' => 'string',
        ];
    }
}
