<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UnsubscribeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email_address' => ['required', 'exists:subscriptions,email_address'],
        ];
    }

    public function messages(): array
    {
        return [
            'email_address.exists' => "We couldn't find a subscription with this email address",
        ];
    }
}
