<?php

declare(strict_types=1);

namespace App\Http\Requests\API\Auth;

use App\Enums\ErrorCode;
use App\Constants\ErrorMessages;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'name',
            'email' => 'email address',
            'password' => 'password',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The :attribute field is required.',
            'name.string' => 'The :attribute must be a string.',
            'name.max' => 'The :attribute may not be greater than 255 characters.',
            'email.required' => 'The :attribute field is required.',
            'email.string' => 'The :attribute must be a string.',
            'email.email' => 'Please enter a valid :attribute.',
            'email.max' => 'The :attribute may not be greater than 255 characters.',
            'email.unique' => 'This :attribute is already registered.',
            'password.required' => 'The :attribute field is required.',
            'password.string' => 'The :attribute must be a string.',
            'password.min' => 'The :attribute must be at least 8 characters.',
            'password.confirmed' => 'The :attribute confirmation does not match.',
        ];
    }

    protected function failedValidation(Validator $validator): never
    {
        $errors = $validator->errors()->all();
        $response = response()->json([
            'success' => false,
            'message' => ErrorMessages::getMessage(ErrorCode::REGISTER_FAILED),
            'status' => 422,
            'error_code' => ErrorCode::REGISTER_FAILED->value,
            'errors' => $errors,
        ], 422);

        throw new HttpResponseException($response);
    }
}
