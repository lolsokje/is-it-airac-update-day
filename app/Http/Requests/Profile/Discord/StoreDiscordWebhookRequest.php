<?php

declare(strict_types=1);

namespace App\Http\Requests\Profile\Discord;

use Illuminate\Foundation\Http\FormRequest;

final class StoreDiscordWebhookRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'webhook_url' => ['required', 'url'],
            'name' => ['required', 'max:255'],
            'enabled' => ['sometimes', 'bool'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->check();
    }
}
