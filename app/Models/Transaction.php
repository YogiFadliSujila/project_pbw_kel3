<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TicketTimeline;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'property_id',
        'transaction_code',
        'price',
        'status',
        'payment_method'
    ];

    // Relasi: Transaksi milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Transaksi milik satu Properti
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    
    // Relasi: Transaksi memiliki banyak TicketTimeline
    public function timelines()
    {
        return $this->hasMany(TicketTimeline::class)->latest();
    }

    public function latestTimeline()
    {
        // Relasi ini akan mengambil satu data timeline paling baru (berdasarkan ID terbesar)
        return $this->hasOne(TicketTimeline::class)->latestOfMany();
    }
}