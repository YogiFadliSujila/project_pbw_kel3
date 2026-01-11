<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyDeal extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'property_id', 'agreed_price', 'status'];

    // Relasi ke Property agar bisa ambil nama/foto properti
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // Relasi ke User (Pembeli)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}