<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil properti yang statusnya Accepted
        $query = Property::with('user')
                    ->where('status', 'Accepted')
                    ->latest();

        // 2. Terapkan Filter Search (Menggunakan ScopeFilter yang sudah kita buat)
        // Jika ada search, dia filter. Jika tidak, dia tampilkan semua.
        $query->filter(request(['search']));

        // 3. Ambil data (Paginate)
        $properties = $query->paginate(12);

        // 4. Selalu return ke view listing, apapun hasilnya
        return view('listing', compact('properties'));
    }
}