<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Cycle;
use App\Models\Subscription;
use App\Support\UnsubscribeTokenGenerator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class NewCycleAvailableNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly Cycle $cycle,
    ) {}

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(Subscription $notifiable): MailMessage
    {
        $unsubscribeUrl = route('subscription.destroy.token', UnsubscribeTokenGenerator::createToken($notifiable));

        return (new MailMessage)
            ->subject('New AIRAC cycle available')
            ->view('mail.airac.available', [
                'cycle' => $this->cycle,
                'url' => $unsubscribeUrl,
            ]);
    }
}
