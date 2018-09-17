<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'nullable|string',
            'idnumber' => 'nullable|string',
            'car_ids' => 'nullable|array',
        ];
    }

    public function messages()
    {
        return [
          'name.required' => '客户姓名不能为空',
          'phone.required' => '客户手机号不能为空',
        ];
    }
}
