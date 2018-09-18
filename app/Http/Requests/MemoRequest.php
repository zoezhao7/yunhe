<?php

namespace App\Http\Requests;

class MemoRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'member_id' => 'nullable|int|exists:members,id',
                    'content' => 'required|string',
                    'handled_at' => 'nullable|date',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    public function messages()
    {
        return [
            // Validation messages
        ];
    }
}
