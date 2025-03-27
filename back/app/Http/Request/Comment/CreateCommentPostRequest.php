<?php

namespace App\Http\Request\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CreateCommentPostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'task_id' => 'required|integer|exists:tasks,id',
        ];
    }
}
