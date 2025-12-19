<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class LandingController extends Controller
{
    public function index()
    {
        // Data Dummy untuk Card Properti (Nanti bisa diganti ambil dari Database)
        $properties = [
            [
                'title' => 'Lahan Perkebunan/Budidaya',
                'location' => 'Jatinangor, Sumedang',
                'price' => '500 Juta',
                'area' => '72',
                'image' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'
            ],
            [
                'title' => 'Rumah Kota Sumedang',
                'location' => 'Sumedang Utara, Jawa Barat',
                'price' => '550 Juta',
                'area' => '90',
                'image' => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'
            ],
            // Tambah data dummy lain jika mau
        ];

        return view('landing', compact('properties'));
    }

    // Tambahkan ini di bawah method index()
    public function listing()
    {
        // Data Dummy sesuai gambar "Page Temukan Lahan (2).jpg"

        $properties = Property::latest()->get(); 

        return view('listing', compact('properties'));

       


    }
}