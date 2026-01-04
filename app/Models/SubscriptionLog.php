<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_code',
        'package_name',
        'price',
        'duration_days',
        'status',
        'start_date',
        'end_date',
    ];

    // Mengubah kolom tanggal menjadi objek Carbon otomatis
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // Relasi: Log langganan milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}