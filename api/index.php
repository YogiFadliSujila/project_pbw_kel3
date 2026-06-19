<?php
// Memuat autoloader dan file utama Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 1. Tentukan folder sementara /tmp khusus Vercel
$storagePath = '/tmp/storage';
$bootstrapPath = '/tmp/bootstrap';

// 2. Buat semua sub-folder yang diwajibkan oleh Laravel
$directories = [
    "$storagePath/app/public",
    "$storagePath/framework/cache/data",
    "$storagePath/framework/sessions",
    "$storagePath/framework/testing",
    "$storagePath/framework/views",
    "$storagePath/logs",
    "$bootstrapPath/cache", // <-- Kunci utama penyelesaian error saat ini
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// 3. Paksa aplikasi Laravel menggunakan folder /tmp tersebut
$app->useStoragePath($storagePath);
$app->useBootstrapPath($bootstrapPath);

// 4. Jalankan aplikasi
$app->handleRequest(Illuminate\Http\Request::capture());