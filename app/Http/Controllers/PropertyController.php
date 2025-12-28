<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        // 1. Mulai Query dasar & Sorting
        $query = Property::with('user')
                    ->orderBy('priority_level', 'asc')
                    ->latest();

        // 2. PANGGIL SEARCH DARI MODEL (Menggantikan logika manual yang panjang)
        // Pastikan Anda sudah menambahkan scopeFilter di Model Property
        $query->filter(request(['search']));

        // 3. Logika Filter Status (Admin Specific)
        // Kita biarkan manual karena ada opsi 'All Status' yang spesifik untuk admin
        if ($request->has('status') && $request->status != 'All Status') {
            $query->where('status', $request->status);
        }

        // 4. Eksekusi Data
        // Saya sarankan ganti ->get() menjadi ->paginate(10) agar halaman tidak berat
        $properties = $query->paginate(10); 

        return view('properties.index', compact('properties'));
    }

    // Menampilkan Form
    public function create()
    {
        return view('properties.create');
    }

    // Menyimpan Data ke Database
    public function store(Request $request)
    {
        $user = Auth::user();

        // [LOGIKA FASE 3] Cek Kuota Upload Sebelum Validasi
        if ($user) {
            $currentPropertiesCount = Property::where('user_id', $user->id)->count();
            
            $membership = $user->membership_type ?? 'Basic';
            
            $limit = match($membership) {
                'Silver' => 5,
                'Gold'   => 9999, // Unlimited
                default  => 3,    // Basic
            };

            if ($currentPropertiesCount >= $limit) {
                return redirect()->back()->with('error', "Anda telah mencapai batas kuota upload paket {$membership}. Silakan upgrade untuk menambah kuota.");
            }
        }

        // 1. Validasi Input (UPDATE: Tambah Validasi Galeri)
        $validated = $request->validate([
            'description'    => 'required',
            'price'          => 'required|numeric',
            'location'       => 'required',
            'specifications' => 'required',
            'area'           => 'required',
            'category'       => 'required',
            
            // Foto Utama (Thumbnail)
            'image'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
            
            // Dokumen
            'document'       => 'required|mimes:pdf,doc,docx|max:5120',

            // [BARU] Foto Galeri (Array)
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi per file
            'gallery_images'   => 'max:10', // Maksimal 10 file
            'latitude' => 'nullable|numeric',   // Validasi baru
            'longitude' => 'nullable|numeric',  // Validasi baru
        ]);

        // 2. Handle Upload Foto Utama (Thumbnail)
        if ($request->hasFile('image')) {
            $pathImg = $request->file('image')->store('properties/images', 'public');
            // Simpan path relatif saja agar lebih bersih di database, atau gunakan '/storage/' sesuai preferensi Anda
            // Disini saya mengikuti format lama Anda:
            $validated['image'] = '/storage/' . $pathImg;
        }

        // 3. Handle Upload Dokumen
        if ($request->hasFile('document')) {
            $pathDoc = $request->file('document')->store('properties/documents', 'public');
            $validated['document'] = '/storage/' . $pathDoc;
        }

        // 4. Setup User & Paket
        if ($user) {
            $validated['user_id'] = $user->id;
            $membershipType = $user->membership_type ?? 'Basic';
        } else {
            // Logic Guest/Dummy User
            $uniq = time() . rand(1000, 9999);
            $dummy = User::create([
                'name' => 'Dummy User ' . $uniq,
                'email' => 'dummy+' . $uniq . '@example.test',
                'phone' => null,
                'password' => Str::random(16),
                'role' => 'penjual',
                'membership_type' => 'Basic'
            ]);
            $validated['user_id'] = $dummy->id;
            $membershipType = 'Basic';
        }

        // [LOGIKA FASE 3] Set Priority & Expiration
        $priorityLevel = 3; 
        $autoExpireAt = null;

        if ($membershipType == 'Gold') {
            $priorityLevel = 1; 
        } elseif ($membershipType == 'Silver') {
            $priorityLevel = 2; 
        } else {
            $priorityLevel = 3;
            $autoExpireAt = Carbon::now()->addDays(60); 
        }

        $validated['status'] = 'Pending';
        $validated['ads_category'] = $membershipType;
        $validated['priority_level'] = $priorityLevel;
        $validated['auto_expire_at'] = $autoExpireAt;
        $validated['latitude'] = $request->latitude;
        $validated['longitude'] = $request->longitude;

        
        // 5. Simpan Data Property ke Database
        // Kita tampung ke variabel $property agar bisa dipakai untuk simpan galeri
        $property = Property::create($validated);

        // [BARU] 6. Handle Upload Foto Galeri
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                // Simpan file
                $path = $file->store('properties/gallery', 'public');
                
                // Simpan ke tabel property_images via relasi
                // Pastikan Anda sudah membuat relasi images() di model Property
                $property->gallery()->create([
                    'image_path' => $path // Simpan path raw (tanpa /storage/) atau sesuaikan
                ]);
            }
        }

        // 7. Redirect
        if ($user && $user->role === 'admin') {
            return redirect()->route('properties.index')->with('success', 'Properti berhasil ditambahkan!');
        }

        return redirect()->route('listing.index')->with('success', 'Properti berhasil ditambahkan!');
    }

    // Menampilkan Halaman Edit Status
    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    // Memproses Perubahan Status
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'status' => 'required|in:Pending,Accepted,Rejected,Sold',
        ]);

        $property->update([
            'status' => $request->status
        ]);

        return redirect()->route('properties.index')->with('success', 'Status properti berhasil diperbarui!');
    }
    
    // Menghapus Property
    public function destroy(Property $property)
    {
        // 1. Hapus File Foto Utama
        if ($property->image) {
            $imagePath = str_replace('/storage/', '', $property->image);
            Storage::disk('public')->delete($imagePath);
        }

        // 2. Hapus File Dokumen
        if ($property->document) {
            $docPath = str_replace('/storage/', '', $property->document);
            Storage::disk('public')->delete($docPath);
        }

        // [BARU] 3. Hapus File Foto Galeri
        // Loop semua gambar galeri terkait dan hapus dari storage
        foreach ($property->gallery as $galleryImage) {
            // Asumsi image_path disimpan tanpa '/storage/' prefix di loop store di atas.
            // Jika Anda menyimpannya dengan prefix, gunakan str_replace seperti di atas.
            Storage::disk('public')->delete($galleryImage->image_path);
        }

        // 4. Hapus Data (Termasuk data di tabel property_images karena onDelete cascade)
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Properti dan semua file terkait berhasil dihapus!');
    }
}