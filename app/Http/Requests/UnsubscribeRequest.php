<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UnsubscribeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'exists:subscriptions,email'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.exists' => "We couldn't find a subscription with this email address",
        ];
    }
}
