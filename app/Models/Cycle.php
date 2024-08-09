<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'starts_at' => 'date:Y-m-d',
    ];

    public function releasesToday(): bool
    {
        return $this->starts_at->isToday();
    }

    public function hasBeenReleased(): bool
    {
        return $this->releasesToday() && (int) Carbon::now()->format('G') >= 9;
    }
}
