<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Daftar 5 Admin Kelompok
        $admins = [
            [
                'name' => 'Yogi', // Ganti Nama 1
                'email' => 'yogi@landhub.com',
                'password' => Hash::make('230660121072'), // Password masing-masing
                'role' => 'admin',
            ],
            [
                'name' => 'Rama', // Ganti Nama 2
                'email' => 'rama@landhub.com',
                'password' => Hash::make('230660121169'),
                'role' => 'admin',
            ],
            [
                'name' => 'Dini', // Ganti Nama 3
                'email' => 'dini@landhub.com',
                'password' => Hash::make('230660121051'),
                'role' => 'admin',
            ],
            [
                'name' => 'Syakar', // Ganti Nama 4
                'email' => 'syakar@landhub.com',
                'password' => Hash::make('230660121122'),
                'role' => 'admin',
            ],
            [
                'name' => 'Adis', // Ganti Nama 5
                'email' => 'adis@landhub.com',
                'password' => Hash::make('230660121124'),
                'role' => 'admin',
            ],
        ];

        foreach ($admins as $key => $value) {
            User::create($value);
        }
    }
}