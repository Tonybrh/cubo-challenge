<?php

namespace App\Http\Request\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskStatusDateFilteredRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'integer|min:1',
            'page' => 'nullable|integer|min:1'
        ];
    }
}
