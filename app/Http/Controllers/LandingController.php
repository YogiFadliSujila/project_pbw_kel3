<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class LandingController extends Controller
{
    public function index()
    {
        // Ambil properti terbaru berstatus 'available' untuk ditampilkan di landing
        // Batasi jumlah menjadi 2 sample agar tidak memuat terlalu banyak data
        $properties = Property::latest()
            ->where('status', 'available')
            ->take(2)
            ->get();

        return view('landing', compact('properties'));
    }

    // Tambahkan ini di bawah method index()
    public function listing()
    {
        // Ambil semua properti berstatus 'available' untuk halaman listing
        $properties = Property::latest()
            ->where('status', 'available')
            ->get();

        return view('listing', compact('properties'));

       


    }

    // Tambahkan di bawah method listing()
    public function show($id)
    {
        // Cari properti berdasarkan ID, jika tidak ketemu tampilkan 404
        $property = Property::findOrFail($id);

        // Kirim data ke view detail
        return view('detail', compact('property'));
    }
}