<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class EditTaskPutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['string'],
            'description' => ['string'],
            'task_status_id' => ['string'],
        ];
    }
}
