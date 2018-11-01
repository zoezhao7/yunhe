<?php

namespace App\Http\Requests;

use function Couchbase\defaultDecoder;
use Illuminate\Foundation\Http\FormRequest;

class NodeRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            case 'PUT':
            case 'PATCH':
                return [
                    'controller_name' => 'required',
                    'controller' => 'required|regex:/^[a-zA-Z0-9]+(,[a-zA-Z0-9]+)*?$/',
                    'action_name' => 'required',
                    'action' => 'required|string',
                ];
                break;
            default:
                return [];
                break;
        }
    }

    public function messages()
    {
        return [
          'controller_name.required' => '控制器名称不能为空',
          'controller.required' => '控制器不能为空',
          'action_name.required' => '操作名称不能为空',
          'action.required' => '操作不能为空',
        ];
    }
}
