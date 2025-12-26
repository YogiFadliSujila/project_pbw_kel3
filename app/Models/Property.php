<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi: Property dimiliki oleh User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

