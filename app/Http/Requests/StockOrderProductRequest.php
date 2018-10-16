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
            'number' => 'required|int',
            'remark' => 'string',
        ];
    }
}
