<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRoleRequest extends FormRequest
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
        switch ($this->method()){
            case 'POST':
                return [
                    'name' => 'required|unique:employee_roles,name,,,deleted_at,null',
                    'node_ids' => 'required|array'
                ];
                break;
            case 'PUT':
            case 'PATCH':
                $id = $this->route('role')->id;
                return [
                    'name' => 'required|unique:employee_roles,name,' . $id . ',id,deleted_at,null',
                    'node_ids' => 'required|array'
                ];
                break;
            default;
                return [];
                break;

        }
    }

    public function messages()
    {
        return [
            'name.required' => '角色名称不能为空',
            'name.unique' => '角色名不能重复',
            'node_ids.required' => '角色权限不能为空',
        ];
    }
}
