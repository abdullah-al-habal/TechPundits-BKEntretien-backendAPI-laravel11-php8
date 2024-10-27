<?php

namespace App\Http\Requests\API\V1\Notification;

use Illuminate\Foundation\Http\FormRequest;

class SendNotificationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255'
            ],
            'body' => [
                'required',
                'string'
            ],
            'token' => [
                'required',
                'string'
            ],
            'platform' => [
                'sometimes',
                'string',
                'in:android,ios'
            ],
        ];
    }
}
