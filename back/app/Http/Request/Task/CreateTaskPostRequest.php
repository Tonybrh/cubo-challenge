<?php

namespace App\Http\Request\Task;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['string', 'required'],
            'description' => ['string', 'required'],
            'task_status_id' => ['integer', 'required'],
        ];
    }
}
