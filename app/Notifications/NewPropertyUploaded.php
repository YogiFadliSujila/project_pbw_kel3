<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Property;

class NewPropertyUploaded extends Notification
{
    use Queueable;

    protected $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'property_uploaded',
            'property_id' => $this->property->id,
            'title' => $this->property->title ?? 'Properti baru',
            'message' => 'Properti baru telah diunggah: ' . ($this->property->title ?? 'Properti'),
            'link' => route('property.show', $this->property->id)
        ];
    }
}
