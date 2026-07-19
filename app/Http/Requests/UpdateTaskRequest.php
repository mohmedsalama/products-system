<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:10',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'user_id' => 'required|exists:users,id',
        ];
    }
}