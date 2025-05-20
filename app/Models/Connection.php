<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\AvailableProviders;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Connection extends Model
{
    use HasUuids;

    protected $casts = [
        'provider' => AvailableProviders::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
