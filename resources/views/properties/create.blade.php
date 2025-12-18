<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mulai Promosikan Lahanmu - LandHub</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Styling khusus untuk input harga dengan prefix Rp */
        .price-input-container:focus-within {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white py-4 px-6 flex justify-between items-center shadow-sm">
        <a href="{{ route('properties.index') }}" class="text-2xl font-bold text-blue-900">LandHub</a>
        <div class="flex items-center gap-6">
            <a href="#" class="text-gray-600 hover:text-blue-900 font-medium">Home</a>
            <a href="#" class="text-gray-600 hover:text-blue-900 font-medium">About Us</a>
            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
            </div>
        </div>
    </nav>

    <div class="bg-blue-50 py-3 px-6">
        <a href="{{ route('properties.index') }}" class="text-gray-600 hover:text-blue-900 flex items-center gap-2 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
    </div>

    <header class="bg-blue-50 pt-10 pb-6 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-blue-900 mb-3">Mulai Promosikan Lahan mu <br> hanya di LandHub</h1>
        <p class="text-gray-600 text-lg">isi data berikut untuk melengkapi proses registrasi</p>
    </header>

    <main class="container mx-auto px-4 py-10 flex justify-center bg-blue-50 pb-20">
        <div class="bg-white rounded-2xl shadow-sm p-8 w-full max-w-3xl border border-gray-100">

            <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Property</label>
                    <textarea name="description" rows="4" placeholder="Masukan Deskripsi Property" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3" required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga Property</label>
                    <div class="price-input-container flex items-center bg-gray-50 rounded-lg border border-gray-300 overflow-hidden">
                        <span class="px-4 py-3 text-gray-500 font-medium bg-gray-100 border-r border-gray-300">Rp</span>
                        <input type="number" name="price" placeholder="Masukan Nominal Property" class="w-full border-none focus:ring-0 bg-transparent p-3" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Property</label>
                    <input type="text" name="location" placeholder="Masukan Lokasi Property" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Spesifikasi Property</label>
                    <input type="text" name="specifications" placeholder="Masukan Spesifikasi Property" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Luas Property</label>
                        <div class="flex items-center gap-2">
                            <input type="text" name="area" placeholder="Contoh: 150" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3 text-center" required>
                            <span class="text-gray-700 font-medium">m²</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option>Rumah</option>
                            <option>Tanah</option>
                            <option>Ruko</option>
                            <option>Apartemen</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-4">Kategori Iklan</label>
                    <div class="flex flex-wrap items-center gap-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="ads_category" value="Basic" class="peer sr-only" required>
                            <div class="px-6 py-2 rounded-full border-2 border-blue-200 text-blue-700 font-medium peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 transition text-center min-w-[100px]">Basic</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="ads_category" value="Silver" class="peer sr-only">
                            <div class="px-6 py-2 rounded-full border-2 border-gray-300 text-gray-700 font-medium peer-checked:bg-gray-600 peer-checked:text-white peer-checked:border-gray-600 transition text-center min-w-[100px]">Silver</div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="ads_category" value="Gold" class="peer sr-only">
                            <div class="px-6 py-2 rounded-full border-2 border-yellow-400 text-yellow-700 font-medium peer-checked:bg-yellow-500 peer-checked:text-white peer-checked:border-yellow-500 transition text-center min-w-[100px]">Gold</div>
                        </label>
                        <a href="#" class="text-blue-600 hover:underline text-sm font-medium ml-auto">Lihat detail Kategori</a>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-4">Konfirmasi Surat Kepemilikan Property dan Foto</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 hover:bg-gray-100 transition p-6 text-center cursor-pointer group relative">
                            <input type="file" name="document" id="upload-doc" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept=".pdf,.doc,.docx">
                            <div class="flex flex-col items-center justify-center h-full">
                                <svg class="w-12 h-12 text-gray-400 group-hover:text-blue-500 mb-3 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <p class="text-sm font-bold text-gray-700 group-hover:text-blue-600">Upload File</p>
                                <p class="text-xs text-gray-500 mt-1" id="doc-name">Format: PDF, DOC (Max 5MB)</p>
                            </div>
                        </div>
                        
                        <div class="border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 hover:bg-gray-100 transition p-6 text-center cursor-pointer group relative">
                            <input type="file" name="image" id="upload-img" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/png, image/jpeg, image/jpg">
                            <div class="flex flex-col items-center justify-center h-full">
                                <svg class="w-12 h-12 text-gray-400 group-hover:text-blue-500 mb-3 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="text-sm font-bold text-gray-700 group-hover:text-blue-600">Upload Foto</p>
                                <p class="text-xs text-gray-500 mt-1" id="img-name">Format: JPG, PNG (Max 2MB)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button type="submit" class="bg-blue-900 text-white text-lg font-bold py-4 px-12 rounded-xl hover:bg-blue-800 transition shadow-lg">
                        Pasang Iklan
                    </button>
                </div>

            </form>
        </div>
    </main>

    <footer class="bg-white py-10 px-6 border-t border-gray-200">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            <div>
                <h2 class="text-2xl font-bold text-blue-900 mb-3">LandHub</h2>
                <p class="text-gray-600 text-sm">Temukan Lahan Impianmu <br> di LandHub</p>
            </div>
            <div>
                <h3 class="font-bold text-gray-900 mb-3">Tentang Kami :</h3>
                <ul class="text-gray-600 text-sm space-y-2">
                    <li>Mahasiswa Informatika</li>
                    <li>Universitas Sebelas April</li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-gray-900 mb-3">Hubungi Kami :</h3>
                <ul class="text-gray-600 text-sm space-y-2">
                    <li>info@LandHub.com</li>
                    <li>+62 12 345678999</li>
                </ul>
            </div>
        </div>
        <div class="container mx-auto text-center text-gray-500 text-sm mt-10">
            © LandHub 2025 - by greatest team 3 ❤️
        </div>
    </footer>

    <script>
        document.getElementById('upload-doc').addEventListener('change', function(e) {
            document.getElementById('doc-name').textContent = e.target.files[0].name;
        });
        document.getElementById('upload-img').addEventListener('change', function(e) {
            document.getElementById('img-name').textContent = e.target.files[0].name;
        });
    </script>

</body>
</html>