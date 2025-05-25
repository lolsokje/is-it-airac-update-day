<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('completed_discord_webhooks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('discord_webhook_id')->constrained('discord_webhooks');
            $table->foreignId('cycle_id')->constrained('cycles');
            $table->timestamp('completed_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('completed_discord_webhooks');
    }
};
