<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Message;

class NewMessageReceived extends Notification
{
    use Queueable;

    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $conversation = $this->message->conversation;
        return [
            'type' => 'message_received',
            'message_id' => $this->message->id,
            'conversation_id' => $this->message->conversation_id,
            'from_user_id' => $this->message->user_id,
            'body' => substr($this->message->body ?? '', 0, 200),
            'link' => route('chat.index', ['conversation_id' => $this->message->conversation_id])
        ];
    }
}
