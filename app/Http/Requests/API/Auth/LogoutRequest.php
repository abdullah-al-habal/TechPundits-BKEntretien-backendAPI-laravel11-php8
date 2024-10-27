<?php

declare(strict_types=1);

namespace App\Http\Requests\API\Auth;

use App\Enums\ErrorCode;
use App\Constants\ErrorMessages;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LogoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }

    protected function failedValidation(Validator $validator): never
    {
        $errors = $validator->errors()->all();
        $response = response()->json([
            'success' => false,
            'message' => ErrorMessages::getMessage(ErrorCode::LOGOUT_FAILED),
            'status' => 422,
            'error_code' => ErrorCode::LOGOUT_FAILED->value,
            'errors' => $errors,
        ], 422);

        throw new HttpResponseException($response);
    }
}
