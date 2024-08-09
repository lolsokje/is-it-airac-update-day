<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class SubscribeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email_address' => ['required', 'unique:subscriptions,email_address', 'email:rfc'],
        ];
    }

    public function messages(): array
    {
        return [
            'email_address.unique' => 'This email address is already signed up',
        ];
    }
}
