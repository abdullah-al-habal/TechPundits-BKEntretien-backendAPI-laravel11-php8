<?php

declare(strict_types=1);

namespace App\Http\Requests\API\Auth;

use App\Enums\ErrorCode;
use App\Constants\ErrorMessages;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'email address',
            'password' => 'password',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'The :attribute field is required.',
            'email.string' => 'The :attribute must be a string.',
            'email.email' => 'Please enter a valid :attribute.',
            'email.max' => 'The :attribute may not be greater than 255 characters.',
            'password.required' => 'The :attribute field is required.',
            'password.string' => 'The :attribute must be a string.',
            'password.min' => 'The :attribute must be at least 8 characters.',
        ];
    }

    protected function failedValidation(Validator $validator): never
    {
        $errors = $validator->errors()->all();
        $response = response()->json([
            'success' => false,
            'message' => ErrorMessages::getMessage(ErrorCode::LOGIN_FAILED),
            'status' => 422,
            'error_code' => ErrorCode::LOGIN_FAILED->value,
            'errors' => $errors,
        ], 422);

        throw new HttpResponseException($response);
    }
}
