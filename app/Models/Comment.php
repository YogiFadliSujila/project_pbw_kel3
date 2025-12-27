<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'property_id', 'body', 'parent_id'];

    // Relasi ke User (Penulis Komentar)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Properti (Tempat Komentar)
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->oldest();
    }
}