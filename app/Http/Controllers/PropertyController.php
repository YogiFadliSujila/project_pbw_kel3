<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon; // Pastikan import ini ada untuk fitur expired

class PropertyController extends Controller
{

    public function index(Request $request){
        // Mulai query, sertakan data user pemiliknya
        // UPDATE FASE 4: Urutkan berdasarkan priority_level (asc) lalu created_at (desc)
        // Level 1 (Gold) tampil duluan, baru Level 2 (Silver), dst.
        $query = \App\Models\Property::with('user')
             ->where('status', 'Accepted'); // Pastikan hanya Accepted
             
        $query = Property::with('user')->orderBy('priority_level', 'asc')->latest();

        // 1. Logika Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', '%'.$search.'%')
                ->orWhere('location', 'like', '%'.$search.'%')
                ->orWhere('category', 'like', '%'.$search.'%');
            });
        }

        // 2. Logika Filter Status
        if ($request->has('status') && $request->status != 'All Status') {
            $query->where('status', $request->status);
        }

        $properties = $query->orderBy('priority_level', 'asc')
                        ->latest()
                        ->get();

        return view('properties.index', compact('properties'));
    }

    // Menampilkan Form
    public function create(){
        return view('properties.create');
    }

    // Menyimpan Data ke Database
    public function store(Request $request){
        
        $user = Auth::user();

        // [LOGIKA BARU - FASE 3] Cek Kuota Upload Sebelum Validasi
        if ($user) {
            $currentPropertiesCount = Property::where('user_id', $user->id)->count();
            
            // Tentukan limit berdasarkan paket (Default Basic jika null)
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

        // 1. Validasi Input
        $validated = $request->validate([
            'description' => 'required',
            'price' => 'required|numeric',
            'location' => 'required',
            'specifications' => 'required',
            'area' => 'required',
            'category' => 'required',
            // 'ads_category' tidak perlu required dari form, karena kita ambil dari user membership
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'document' => 'required|mimes:pdf,doc,docx|max:5120',
        ]);

        // 2. Handle Upload Gambar
        if ($request->hasFile('image')) {
            $pathImg = $request->file('image')->store('properties/images', 'public');
            $validated['image'] = '/storage/' . $pathImg;
        }

        // 3. Handle Upload Dokumen
        if ($request->hasFile('document')) {
            $pathDoc = $request->file('document')->store('properties/documents', 'public');
            $validated['document'] = '/storage/' . $pathDoc;
        }

        // 4. Tentukan user pemilik & Setup Paket
        if ($user) {
            $validated['user_id'] = $user->id;
            $membershipType = $user->membership_type ?? 'Basic';
        } else {
            // Logic Guest/Dummy User (Otomatis dapat paket Basic)
            $uniq = time() . rand(1000, 9999);
            $dummy = User::create([
                'name' => 'Dummy User ' . $uniq,
                'email' => 'dummy+' . $uniq . '@example.test',
                'phone' => null,
                'password' => Str::random(16),
                'role' => 'penjual',
                'membership_type' => 'Basic' // Default dummy
            ]);
            $validated['user_id'] = $dummy->id;
            $membershipType = 'Basic';
        }

        // [LOGIKA BARU - FASE 3] Set Priority & Expiration berdasarkan Paket
        $priorityLevel = 3; // Default Basic
        $autoExpireAt = null;

        if ($membershipType == 'Gold') {
            $priorityLevel = 1; // Paling atas
        } elseif ($membershipType == 'Silver') {
            $priorityLevel = 2; // Menengah
        } else {
            // Basic: Priority 3 & Expired dalam 60 hari
            $priorityLevel = 3;
            $autoExpireAt = Carbon::now()->addDays(60); 
        }

        // Masukkan data tambahan ke array $validated
        $validated['status'] = 'Pending';
        $validated['ads_category'] = $membershipType; // Simpan tipe paket saat upload
        $validated['priority_level'] = $priorityLevel;
        $validated['auto_expire_at'] = $autoExpireAt;

        // 5. Simpan ke Database
        Property::create($validated);

        // 6. Redirect
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
        // 1. Hapus File Gambar
        if ($property->image) {
            $imagePath = str_replace('/storage/', '', $property->image);
            Storage::disk('public')->delete($imagePath);
        }

        // 2. Hapus File Dokumen
        if ($property->document) {
            $docPath = str_replace('/storage/', '', $property->document);
            Storage::disk('public')->delete($docPath);
        }

        // 3. Hapus Data
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Properti dan file terkait berhasil dihapus!');
    }
}