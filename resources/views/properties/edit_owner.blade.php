<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Properti - LandHub</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white py-4 px-6 flex justify-between items-center shadow-sm">
        <a href="{{ route('properties.index') }}" class="text-2xl font-bold text-blue-900">LandHub</a>
        <div class="flex items-center gap-6">
            <a href="#" class="text-gray-600 hover:text-blue-900 font-medium">Home</a>
            <a href="#" class="text-gray-600 hover:text-blue-900 font-medium">About Us</a>
        </div>
    </nav>

    <header class="bg-blue-50 pt-10 pb-6 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-blue-900 mb-3">Edit Properti</h1>
        <p class="text-gray-600 text-lg">Perbarui data properti Anda</p>
    </header>

    <main class="container mx-auto px-4 py-10 flex justify-center bg-blue-50 pb-20">
        <div class="bg-white rounded-2xl shadow-sm p-8 w-full max-w-3xl border border-gray-100">

            <form action="{{ route('properties.owner.update', $property->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Property</label>
                    <input type="text" name="description" value="{{ old('description', $property->description) }}" placeholder="Masukan Deskripsi Property" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Harga Property</label>
                    <div class="price-input-container flex items-center bg-gray-50 rounded-lg border border-gray-300 overflow-hidden">
                        <span class="px-4 py-3 text-gray-500 font-medium bg-gray-100 border-r border-gray-300">Rp</span>
                        <input type="number" name="price" value="{{ old('price', $property->price) }}" placeholder="Masukan Nominal Property" class="w-full border-none focus:ring-0 bg-transparent p-3" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lokasi Property</label>
                    <input type="text" name="location" value="{{ old('location', $property->location) }}" placeholder="Masukan Lokasi Property" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                        <input type="text" name="latitude" value="{{ old('latitude', $property->latitude) }}" placeholder="Contoh: -6.200000" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                        <input type="text" name="longitude" value="{{ old('longitude', $property->longitude) }}" placeholder="Contoh: 106.816666" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3">
                    </div>
                </div>

                <div class="text-xs text-gray-500 mt-1 mb-4">*Buka Google Maps, klik kanan pada lokasi, lalu salin angka koordinat (cth: -6.2088, 106.8456)</div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Spesifikasi Property</label>
                    <textarea name="specifications" rows="4" placeholder="Masukan Spesifikasi Property" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3" required>{{ old('specifications', $property->specifications) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Luas Property</label>
                        <div class="flex items-center gap-2">
                            <input type="text" name="area" value="{{ old('area', $property->area) }}" placeholder="Contoh: 150" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3 text-center" required>
                            <span class="text-gray-700 font-medium">m²</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3" required>
                            <option value="" disabled>Pilih Kategori</option>
                            <option {{ old('category', $property->category) == 'Rumah' ? 'selected' : '' }}>Rumah</option>
                            <option {{ old('category', $property->category) == 'Tanah' ? 'selected' : '' }}>Tanah</option>
                            <option {{ old('category', $property->category) == 'Ruko' ? 'selected' : '' }}>Ruko</option>
                            <option {{ old('category', $property->category) == 'Apartemen' ? 'selected' : '' }}>Apartemen</option>
                        </select>
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
                                <p class="text-xs text-gray-500 mt-1" id="doc-name">Saat ini: {{ $property->document ? basename($property->document) : 'Belum ada' }}</p>
                            </div>
                        </div>
                        
                        <div class="border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 hover:bg-gray-100 transition p-6 text-center cursor-pointer group relative">
                            <input type="file" name="image" id="upload-img" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/png, image/jpeg, image/jpg">
                            <div class="flex flex-col items-center justify-center h-full">
                                <svg class="w-12 h-12 text-gray-400 group-hover:text-blue-500 mb-3 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="text-sm font-bold text-gray-700 group-hover:text-blue-600">Upload Foto</p>
                                <p class="text-xs text-gray-500 mt-1" id="img-name">Saat ini: {{ $property->image ? basename($property->image) : 'Belum ada' }}</p>
                            </div>
                        </div>

                    </div> 
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Galeri (Maks 10)</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 hover:bg-gray-100 transition p-6 text-center cursor-pointer group relative">
                            <input type="file" name="gallery_images[]" id="upload-gallery" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/png, image/jpeg, image/jpg" multiple>
                            
                            <div class="flex flex-col items-center justify-center h-full">
                                <svg class="w-12 h-12 text-gray-400 group-hover:text-blue-500 mb-3 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="text-sm font-bold text-gray-700 group-hover:text-blue-600">Pilih Foto Tambahan</p>
                                <p class="text-xs text-gray-500 mt-1" id="gallery-count">Galeri saat ini: {{ $property->gallery->count() }} foto</p>
                            </div>
                        </div>

                        @if($property->gallery->count() > 0)
                            <div class="mt-4 grid grid-cols-3 gap-3">
                                @foreach($property->gallery as $img)
                                    <div class="w-full h-24 overflow-hidden rounded-lg border">
                                        <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>

                </div>

                <div class="flex justify-end mt-8">
                    <button type="submit" class="bg-blue-900 text-white text-lg font-bold py-4 px-12 rounded-xl hover:bg-blue-800 transition shadow-lg">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </main>

    <footer class="bg-white py-10 px-6 border-t border-gray-200">
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
        document.getElementById('upload-gallery').addEventListener('change', function(e) {
            const count = e.target.files.length;
            document.getElementById('gallery-count').textContent = count + " foto dipilih";
        });
    </script>

</body>
</html>
