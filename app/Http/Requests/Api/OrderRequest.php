<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'member_id' => 'required|exists:members,id',
            'car_id' => 'nullable|integer',
            //'spec_id' => 'required|integer|exists:specs,id',
            //'parameters' => 'nullable|string',
            'products' => 'required|array',
            'money' => 'required|numeric|min:1',
            'dealt_at' => 'required|date',
            'number' => 'nullable|integer'
        ];
    }
}
