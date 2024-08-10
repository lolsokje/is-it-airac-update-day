<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Models\Subscription;
use App\Notifications\NewCycleAvailableNotification;
use Illuminate\Notifications\Events\NotificationSent;

final class NotificationSentListener
{
    public function __construct() {}

    public function handle(NotificationSent $event): void
    {
        /** @var NewCycleAvailableNotification $notification */
        $notification = $event->notification;
        /** @var Subscription $notifiable */
        $notifiable = $event->notifiable;

        $notifiable->update([
            'cycle_id' => $notification->cycle->id,
        ]);
    }
}
