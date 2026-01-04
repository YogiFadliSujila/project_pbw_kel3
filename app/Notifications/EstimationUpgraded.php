<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class EstimationUpgraded extends Notification
{
    use Queueable;

    protected $transaction;
    protected $messageText;

    public function __construct($transaction, $messageText = null)
    {
        $this->transaction = $transaction;
        $this->messageText = $messageText ?? 'Estimasi telah diperbarui oleh admin.';
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'transaction_id' => $this->transaction->id,
            'transaction_code' => $this->transaction->transaction_code,
            'property_id' => $this->transaction->property_id,
            'message' => $this->messageText,
            'link' => route('ticket.status', $this->transaction->transaction_code),
            'sent_at' => now()->toDateTimeString(),
        ];
    }
}
