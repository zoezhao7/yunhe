<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarDemoRequest extends FormRequest
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
            'image' => 'required|string',
            'more' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
          'name.required' => '车辆名称不能为空',
          'image.required' => '车辆图片必须上传',
          'more.required' => '参数错误',
        ];
    }
}
