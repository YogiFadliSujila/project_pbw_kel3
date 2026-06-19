<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

    /**
     * Accessor untuk memastikan `image_url` selalu mengembalikan URL yang dapat diakses.
     * - Jika nilai kolom sudah berupa URL penuh, kembalikan apa adanya.
     * - Jika berisi path, coba ambil URL lewat disk `s3` lalu fallback ke `storage` lokal.
     */
    public function getImageUrlAttribute($value)
    {
        // Jika kolom image_url kosong, coba gunakan kolom `image` sebagai sumber
        $imageValue = $value ?: ($this->attributes['image'] ?? null);

        if (empty($imageValue)) {
            return asset('images/placeholder.png');
        }

        if (Str::startsWith($imageValue, ['http://', 'https://', 'data:'])) {
            return $imageValue;
        }

        try {
            // Jika menggunakan disk s3 (Supabase), bangun URL dari path yang disimpan
            if (config('filesystems.disks.s3')) {
                return Storage::disk('s3')->url($imageValue);
            }
        } catch (\Exception $e) {
            // ignore dan jatuhkan ke fallback
        }

        // Jika value mengandung prefix storage (mis. '/storage/...'), kembalikan asset yang sesuai
        if (Str::startsWith($imageValue, ['/storage/', 'storage/'])) {
            return asset(ltrim($imageValue, '/'));
        }

        return asset('storage/' . ltrim($imageValue, '/'));
    }

    /**
     * Accessor untuk mendapatkan URL dokumen (document)
     */
    public function getDocumentUrlAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        if (Str::startsWith($value, ['http://', 'https://'])) {
            return $value;
        }

        try {
            if (config('filesystems.disks.s3')) {
                return Storage::disk('s3')->url($value);
            }
        } catch (\Exception $e) {
            // ignore
        }

        if (Str::startsWith($value, ['/storage/', 'storage/'])) {
            return asset(ltrim($value, '/'));
        }

        return asset('storage/' . ltrim($value, '/'));
    }

}

