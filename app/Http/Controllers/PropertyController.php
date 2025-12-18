<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property; // PENTING: Panggil model Property
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{

    public function index(Request $request){
        // Mulai query, sertakan data user pemiliknya
        $query = Property::with('user');

        // 1. Logika Search (Mencari berdasarkan Deskripsi, Kategori, atau Lokasi)
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

        // Eksekusi query (ambil data terbaru dulu)
        $properties = $query->latest()->get();

        return view('properties.index', compact('properties'));
    }

    // Menampilkan Form
    public function create(){
        return view('properties.create');
    }

    // Menyimpan Data ke Database
    public function store(Request $request){
        // 1. Validasi Input (Tambahkan validasi untuk document)
        $validated = $request->validate([
            'description' => 'required',
            'price' => 'required|numeric',
            'location' => 'required',
            'specifications' => 'required',
            'area' => 'required',
            'category' => 'required',
            'ads_category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Wajib ada gambar
            'document' => 'required|mimes:pdf,doc,docx|max:5120', // Wajib ada dokumen (max 5MB)
        ]);

        // 2. Handle Upload Gambar
        if ($request->hasFile('image')) {
            $pathImg = $request->file('image')->store('properties/images', 'public');
            $validated['image'] = '/storage/' . $pathImg;
        }

        // 3. Handle Upload Dokumen (BARU)
        if ($request->hasFile('document')) {
            // Simpan di folder storage/app/public/properties/documents
            $pathDoc = $request->file('document')->store('properties/documents', 'public');
            // Simpan path-nya ke database
            $validated['document'] = '/storage/' . $pathDoc;
        }

        

        // 4. Set nilai default (Hardcode user sementara)
        $validated['user_id'] = 1; 
        $validated['status'] = 'Pending';

        // 5. Simpan ke Database
        Property::create($validated);

        // 6. Redirect
        return redirect()->route('properties.index')->with('success', 'Properti berhasil ditambahkan!');
    }

    // Menampilkan Halaman Edit Status
    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
        
    }

    // Memproses Perubahan Status
    public function update(Request $request, Property $property)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|in:Pending,Accepted,Rejected',
        ]);

        // Update status di database
        $property->update([
            'status' => $request->status
        ]);

        // Kembali ke halaman index dengan pesan sukses (opsional)
        return redirect()->route('properties.index')->with('success', 'Status properti berhasil diperbarui!');
    }
    
    // Menghapus Property
    public function destroy(Property $property)
    {
        // 1. Hapus File Gambar (Jika ada)
        if ($property->image) {
            // Kita perlu membersihkan path '/storage/' karena Storage::delete butuh path relatif
            $imagePath = str_replace('/storage/', '', $property->image);
            Storage::disk('public')->delete($imagePath);
        }

        // 2. Hapus File Dokumen (Jika ada)
        if ($property->document) {
            $docPath = str_replace('/storage/', '', $property->document);
            Storage::disk('public')->delete($docPath);
        }

        // 3. Hapus Data dari Database
        $property->delete();

        // 4. Kembali ke halaman index
        return redirect()->route('properties.index')->with('success', 'Properti dan file terkait berhasil dihapus!');
    }

}