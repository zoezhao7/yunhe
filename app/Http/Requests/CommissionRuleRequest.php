<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommissionRuleRequest extends FormRequest
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
            'mins' => 'required|array',
            'maxs' => 'required|array',
            'rates' => 'required|array',
            'subordinate_rate' => 'required|numeric',
        ];
    }

    public function message()
    {
        return [
            'mins.required' => '佣金范围和提成请填写完整',
            'maxs.required' => '佣金范围和提成请填写完整',
            'rates.required' => '佣金范围和提成请填写完整',
            'subordinate_rate.required' => '下线提成请正确填写',
        ];
    }
}
