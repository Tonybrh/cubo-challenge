<?php

namespace App\Http\Request\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class CreateUserPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'required'],
            'email' => ['string', 'email', 'required'],
            'password' => [Password::min(5)->letters()->numbers()]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new \DomainException(
            $errors->first(),
            Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }
}
