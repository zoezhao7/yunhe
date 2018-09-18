<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
                return [
                    'member_id' => 'nullable|integer|exists:members,id',
                    'brand' => 'required|string',
                    'vehicles' => 'required|string',
                    'specs' => 'nullable|string',
                    'color' => 'nullable|string',
                    'plate_number' => 'nullable|string',
                    'image' => 'nullable|string',
                    'production_date' => 'nullable|date',
                    'buy_date' => 'nullable|date',
                ];
                break;
            case 'PUT':
            case 'PATCH':
                return [
                    'brand' => 'required|string',
                    'vehicles' => 'required|string',
                    'specs' => 'string',
                    'color' => 'nullable|string',
                    'plate_number' => 'nullable|string',
                    'image' => 'nullable|string',
                    'production_date' => 'nullable|date',
                    'buy_date' => 'nullable|date',
                ];
                break;
            default:
                return [];
                break;

        }

    }
}
