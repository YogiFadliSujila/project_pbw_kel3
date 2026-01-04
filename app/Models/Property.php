<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// Tambahkan di dalam class Property
use App\Models\Comment; // Jangan lupa import


class Property extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi: Property dimiliki oleh User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Property memiliki banyak PropertyImage
    public function gallery()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function comments()
    {
        // Mengambil komentar urut dari yang terbaru
        return $this->hasMany(Comment::class)->whereNull('parent_id')->oldest();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($q) use ($search) {
                $q->where('description', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%')
                  ->orWhere('category', 'like', '%' . $search . '%')
                  ->orWhere('specifications', 'like', '%' . $search . '%');
            });
        });

        // 2. Filter Kategori (Lahan, Rumah, dll)
        $query->when($filters['category'] ?? false, function($query, $category) {
            return $query->where('category', $category);
        });

        // 3. Filter Harga Min
        $query->when($filters['min_price'] ?? false, function($query, $price) {
            return $query->where('price', '>=', $price);
        });

        // 4. Filter Harga Max
        $query->when($filters['max_price'] ?? false, function($query, $price) {
            return $query->where('price', '<=', $price);
        });
        
        // 5. Filter Area (Luas)
        $query->when($filters['min_area'] ?? false, function($query, $area) {
            return $query->where('area', '>=', $area);
        });
        $query->when($filters['max_area'] ?? false, function($query, $area) {
            return $query->where('area', '<=', $area);
        });
    }

}

