<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Notifications\NewPropertyUploaded;

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
            // Simpan gambar ke Supabase Storage (disk 's3') dan simpan *path* ke database
            // (jangan simpan URL penuh supaya nanti bisa dihapus/dikelola dengan mudah)
            $path = $request->file('image')->store('properties', 's3');
            $validated['image'] = $path;
        }

        // 3. Handle Upload Dokumen (simpan ke S3)
        if ($request->hasFile('document')) {
            // Simpan dokumen ke S3 dan simpan *path* ke DB
            $pathDoc = $request->file('document')->store('properties/documents', 's3');
            $validated['document'] = $pathDoc;
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

        // Kirim notifikasi ke admin bahwa ada property baru (jika ada admin)
        try {
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new NewPropertyUploaded($property));
            }
        } catch (\Exception $e) {
            // silent fail supaya tidak mengganggu proses utama
        }
        // [BARU] 6. Handle Upload Foto Galeri (simpan ke S3)
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                // Simpan file ke S3 dan simpan key/path ke DB
                $path = $file->store('properties/gallery', 's3');

                $property->gallery()->create([
                    'image_path' => $path
                ]);
            }
        }

        // 7. Redirect
        if ($user && $user->role === 'admin') {
            return redirect()->route('properties.index')->with('success', 'Properti berhasil ditambahkan!');
        }

        return redirect()->route('profil')->with('success', 'Properti berhasil ditambahkan!');
    }

    // Menampilkan Halaman Edit Status
    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    // Menampilkan Halaman Edit untuk Owner (Penjual)
    public function editOwner(Property $property)
    {
        $user = Auth::user();

        if (!$user || ($user->id !== $property->user_id && $user->role !== 'admin')) {
            abort(403);
        }

        return view('properties.edit_owner', compact('property'));
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
    
    // Memproses Update Data oleh Owner (Penjual)
    public function updateOwner(Request $request, Property $property)
    {
        $user = Auth::user();

        if (!$user || ($user->id !== $property->user_id && $user->role !== 'admin')) {
            abort(403);
        }

        $validated = $request->validate([
            'description'    => 'required',
            'price'          => 'required|numeric',
            'location'       => 'required',
            'specifications' => 'required',
            'area'           => 'required',
            'category'       => 'required',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'document'       => 'nullable|mimes:pdf,doc,docx|max:5120',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'gallery_images'   => 'max:10',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Handle Upload Foto Utama (ganti jika ada file baru)
        if ($request->hasFile('image')) {
            if ($property->image) {
                $current = $property->image;
                try {
                    if (Str::startsWith($current, ['/storage/', 'storage/'])) {
                        $old = ltrim(str_replace('/storage/', '', $current), '/');
                        Storage::disk('public')->delete($old);
                    } else {
                        // Jika menggunakan S3 (path disimpan tanpa prefix), hapus dari disk s3
                        if (config('filesystems.disks.s3')) {
                            // Jika yang tersimpan adalah URL penuh, coba ekstrak path relatif
                            if (Str::startsWith($current, ['http://', 'https://'])) {
                                try {
                                    $base = rtrim(Storage::disk('s3')->url(''), '/');
                                } catch (\Exception $e) {
                                    $base = null;
                                }
                                if ($base && Str::startsWith($current, $base)) {
                                    $relative = ltrim(substr($current, strlen($base)), '/');
                                    Storage::disk('s3')->delete($relative);
                                } else {
                                    Storage::disk('s3')->delete(basename($current));
                                }
                            } else {
                                Storage::disk('s3')->delete($current);
                            }
                        } else {
                            Storage::disk('public')->delete($current);
                        }
                    }
                } catch (\Exception $e) {
                    // ignore fail
                }
            }

            // Simpan gambar baru ke S3 agar konsisten dengan flow create()
            $pathImg = $request->file('image')->store('properties', 's3');
            $validated['image'] = $pathImg;
        }

        // Handle Upload Dokumen (simpan ke S3)
        if ($request->hasFile('document')) {
            if ($property->document) {
                $currentDoc = $property->document;
                try {
                    if (Str::startsWith($currentDoc, ['/storage/', 'storage/'])) {
                        $oldDoc = ltrim(str_replace('/storage/', '', $currentDoc), '/');
                        Storage::disk('public')->delete($oldDoc);
                    } else {
                        if (config('filesystems.disks.s3')) {
                            if (Str::startsWith($currentDoc, ['http://', 'https://'])) {
                                try {
                                    $base = rtrim(Storage::disk('s3')->url(''), '/');
                                } catch (\Exception $e) {
                                    $base = null;
                                }
                                if ($base && Str::startsWith($currentDoc, $base)) {
                                    $relative = ltrim(substr($currentDoc, strlen($base)), '/');
                                    Storage::disk('s3')->delete($relative);
                                } else {
                                    Storage::disk('s3')->delete(basename($currentDoc));
                                }
                            } else {
                                Storage::disk('s3')->delete($currentDoc);
                            }
                        } else {
                            Storage::disk('public')->delete($currentDoc);
                        }
                    }
                } catch (\Exception $e) {
                    // ignore fail
                }
            }

            $pathDoc = $request->file('document')->store('properties/documents', 's3');
            $validated['document'] = $pathDoc;
        }

        $validated['latitude'] = $request->latitude;
        $validated['longitude'] = $request->longitude;

        // Update property
        $property->update($validated);

        // Handle Upload Foto Galeri (simpan ke S3)
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $path = $file->store('properties/gallery', 's3');
                $property->gallery()->create([
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('profil')->with('success', 'Properti berhasil diperbarui!');
    }
    
    // Menghapus Property
    public function destroy(Property $property)
    {
        // 1. Hapus File Foto Utama
        if ($property->image) {
            $current = $property->image;
            try {
                if (Str::startsWith($current, ['/storage/', 'storage/'])) {
                    $imagePath = ltrim(str_replace('/storage/', '', $current), '/');
                    Storage::disk('public')->delete($imagePath);
                } else {
                    if (config('filesystems.disks.s3')) {
                        // Jika yang tersimpan adalah URL penuh, ekstrak path relatif bila memungkinkan
                        if (Str::startsWith($current, ['http://', 'https://'])) {
                            try {
                                $base = rtrim(Storage::disk('s3')->url(''), '/');
                            } catch (\Exception $e) {
                                $base = null;
                            }
                            if ($base && Str::startsWith($current, $base)) {
                                $relative = ltrim(substr($current, strlen($base)), '/');
                                Storage::disk('s3')->delete($relative);
                            } else {
                                Storage::disk('s3')->delete(basename($current));
                            }
                        } else {
                            Storage::disk('s3')->delete($current);
                        }
                    } else {
                        Storage::disk('public')->delete($current);
                    }
                }
            } catch (\Exception $e) {
                // ignore fail
            }
        }

        // 2. Hapus File Dokumen (dukungan public atau s3)
        if ($property->document) {
            $currentDoc = $property->document;
            try {
                if (Str::startsWith($currentDoc, ['/storage/', 'storage/'])) {
                    $docPath = ltrim(str_replace('/storage/', '', $currentDoc), '/');
                    Storage::disk('public')->delete($docPath);
                } else {
                    if (config('filesystems.disks.s3')) {
                        if (Str::startsWith($currentDoc, ['http://', 'https://'])) {
                            try {
                                $base = rtrim(Storage::disk('s3')->url(''), '/');
                            } catch (\Exception $e) {
                                $base = null;
                            }
                            if ($base && Str::startsWith($currentDoc, $base)) {
                                $relative = ltrim(substr($currentDoc, strlen($base)), '/');
                                Storage::disk('s3')->delete($relative);
                            } else {
                                Storage::disk('s3')->delete(basename($currentDoc));
                            }
                        } else {
                            Storage::disk('s3')->delete($currentDoc);
                        }
                    } else {
                        Storage::disk('public')->delete($currentDoc);
                    }
                }
            } catch (\Exception $e) {
                // ignore fail
            }
        }

        // [BARU] 3. Hapus File Foto Galeri (dukungan public atau s3)
        foreach ($property->gallery as $galleryImage) {
            $current = $galleryImage->image_path;
            try {
                if (Str::startsWith($current, ['/storage/', 'storage/'])) {
                    $path = ltrim(str_replace('/storage/', '', $current), '/');
                    Storage::disk('public')->delete($path);
                } else {
                    if (config('filesystems.disks.s3')) {
                        if (Str::startsWith($current, ['http://', 'https://'])) {
                            try {
                                $base = rtrim(Storage::disk('s3')->url(''), '/');
                            } catch (\Exception $e) {
                                $base = null;
                            }
                            if ($base && Str::startsWith($current, $base)) {
                                $relative = ltrim(substr($current, strlen($base)), '/');
                                Storage::disk('s3')->delete($relative);
                            } else {
                                Storage::disk('s3')->delete(basename($current));
                            }
                        } else {
                            Storage::disk('s3')->delete($current);
                        }
                    } else {
                        Storage::disk('public')->delete($current);
                    }
                }
            } catch (\Exception $e) {
                // ignore fail
            }
        }

        // 4. Hapus Data (Termasuk data di tabel property_images karena onDelete cascade)
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Properti dan semua file terkait berhasil dihapus!');
    }
}