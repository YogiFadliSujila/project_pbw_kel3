<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'receiver_id', 'property_id'];

    // Relasi ke Pesan
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Relasi ke Pengirim (Pembeli)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relasi ke Penerima (Penjual)
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // Relasi ke Properti yang dibahas
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}