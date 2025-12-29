<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mulai Promosikan Lahanmu - LandHub</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
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
            @auth
                <div class="relative">
                    
                    <button onclick="toggleProfilePopup()" class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-800 font-bold border-2 border-transparent hover:border-blue-300 transition focus:outline-none">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </button>

                    <div id="profilePopup" class="hidden absolute right-0 top-14 w-80 bg-white rounded-3xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.2)] border border-gray-100 p-6 z-50 transform origin-top-right transition-all duration-200">
                        
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-full bg-[#F3E8FF] border-2 border-[#7E22CE] flex items-center justify-center text-[#7E22CE]">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-lg text-black">{{ Auth::user()->name }}</h4>
                            </div>

                            <button onclick="toggleProfilePopup()" class="text-black hover:text-gray-500 transition">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>

                        <div class="h-px w-full bg-[#E9D5FF] mb-6"></div>

                        <div class="space-y-3">
                            
                            <a href="#" class="flex items-center justify-between w-full p-4 bg-[#EEF2FF] rounded-xl text-[#1E2B58] font-bold hover:bg-blue-100 transition group">
                                <span>Rekomendasi Lahan</span>
                                <svg class="w-5 h-5 text-black group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>

                            <a href="#" class="flex items-center justify-between w-full p-4 bg-[#EEF2FF] rounded-xl text-[#1E2B58] font-bold hover:bg-blue-100 transition group">
                                <div class="flex items-center gap-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span>Pengaturan</span>
                                </div>
                                <svg class="w-5 h-5 text-black group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 w-full p-4 bg-[#EEF2FF] rounded-xl text-[#1E2B58] font-bold hover:bg-red-50 hover:text-red-600 transition w-full text-left">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    <span>Logout</span>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 hover:bg-purple-200 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </a>
            @endauth

            <script>
                function toggleProfilePopup() {
                    const popup = document.getElementById('profilePopup');
                    if (popup.classList.contains('hidden')) {
                        popup.classList.remove('hidden');
                        // Animasi masuk halus
                        popup.classList.add('opacity-100', 'translate-y-0');
                        popup.classList.remove('opacity-0', '-translate-y-2');
                    } else {
                        popup.classList.add('hidden');
                    }
                }

                // Tutup pop-up jika klik di luar area
                document.addEventListener('click', function(event) {
                    const popup = document.getElementById('profilePopup');
                    const trigger = document.querySelector('button[onclick="toggleProfilePopup()"]');
                    const isClickInside = popup && (popup.contains(event.target) || (trigger && trigger.contains(event.target)));
                    
                    if (!isClickInside && popup && !popup.classList.contains('hidden')) {
                        popup.classList.add('hidden');
                    }
                });
            </script>

        </div>
    </nav>

    <header class="bg-blue-50 pt-10 pb-6 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-blue-900 mb-3">Mulai Promosikan Lahanmu <br> hanya di LandHub</h1>
        <p class="text-gray-600 text-lg">isi data berikut untuk melengkapi proses registrasi</p>
    </header>

    <main class="container mx-auto px-4 py-10 flex justify-center bg-blue-50 pb-20">
        <div class="bg-white rounded-2xl shadow-sm p-8 w-full max-w-3xl border border-gray-100">

            <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Property</label>
                    <input type="text" name="description" placeholder="Masukan Deskripsi Property" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3" required>
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                        <input type="text" name="latitude" placeholder="Contoh: -6.200000" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                        <input type="text" name="longitude" placeholder="Contoh: 106.816666" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3">
                    </div>
                </div>
                <div class="text-xs text-gray-500 mt-1 mb-4">
                    *Buka Google Maps, klik kanan pada lokasi, lalu salin angka koordinat (cth: -6.2088, 106.8456)
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Spesifikasi Property</label>
                    <textarea name="specifications" rows="4" placeholder="Masukan Spesifikasi Property" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-50 p-3" required></textarea>
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
                    
                    <script>
                        function checkAccess(targetLevel, paymentUrl, event) {
                            // 1. Definisi Hirarki Paket
                            const levels = {
                                'Basic': 1,
                                'Silver': 2,
                                'Gold': 3
                            };

                            // 2. Ambil Level User saat ini (dari Blade)
                            const currentUserLevel = levels["{{ Auth::user()->membership_type ?? 'Basic' }}"];
                            const targetUserLevel = levels[targetLevel];

                            // 3. Logika Pengecekan
                            // Jika Target > Current (NAIK KELAS), Block & Redirect
                            if (targetUserLevel > currentUserLevel) {
                                event.preventDefault(); // Batalkan pemilihan radio button
                                
                                // Simpan draft form sebelum pindah halaman (PENTING)
                                if (typeof saveDraft === 'function') {
                                    saveDraft();
                                }

                                // Redirect ke halaman bayar
                                window.location.href = paymentUrl;
                                return false;
                            }

                            // Jika Target <= Current (TURUN/SAMA), Izinkan (Normal)
                            return true;
                        }
                    </script>

                    <div class="flex flex-wrap items-center gap-4">
                        
                        <label class="cursor-pointer">
                            <input type="radio" name="ads_category" value="Basic" class="peer sr-only" 
                                {{ (Auth::user()->membership_type ?? 'Basic') == 'Basic' ? 'checked' : '' }} required>
                            <div class="px-6 py-2 rounded-full border-2 border-blue-200 text-blue-700 font-medium peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600 transition text-center min-w-[100px]">Basic</div>
                        </label>
                        
                        <label class="cursor-pointer">
                            <input type="radio" name="ads_category" value="Silver" class="peer sr-only"
                                {{ Auth::user()->membership_type == 'Silver' ? 'checked' : '' }}
                                onclick="checkAccess('Silver', '{{ route('membership.payment', ['package' => 'Silver']) }}', event)">
                            <div class="px-6 py-2 rounded-full border-2 border-gray-300 text-gray-700 font-medium peer-checked:bg-gray-600 peer-checked:text-white peer-checked:border-gray-600 transition text-center min-w-[100px]">Silver</div>
                        </label>
                        
                        <label class="cursor-pointer">
                            <input type="radio" name="ads_category" value="Gold" class="peer sr-only"
                                {{ Auth::user()->membership_type == 'Gold' ? 'checked' : '' }}
                                onclick="checkAccess('Gold', '{{ route('membership.payment', ['package' => 'Gold']) }}', event)">
                            <div class="px-6 py-2 rounded-full border-2 border-yellow-400 text-yellow-700 font-medium peer-checked:bg-yellow-500 peer-checked:text-white peer-checked:border-yellow-500 transition text-center min-w-[100px]">Gold</div>
                        </label>
                        
                        <a href="{{route('pricing.index')}}" class="text-blue-600 hover:underline text-sm font-medium ml-2" onclick="saveDraft()">Lihat detail / Upgrade</a>
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
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto Galeri (Maks 10)</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 hover:bg-gray-100 transition p-6 text-center cursor-pointer group relative">
                            <input type="file" name="gallery_images[]" id="upload-gallery" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/png, image/jpeg, image/jpg" multiple>
                            
                            <div class="flex flex-col items-center justify-center h-full">
                                <svg class="w-12 h-12 text-gray-400 group-hover:text-blue-500 mb-3 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <p class="text-sm font-bold text-gray-700 group-hover:text-blue-600">Pilih Foto Tambahan</p>
                                <p class="text-xs text-gray-500 mt-1" id="gallery-count">Bisa pilih banyak sekaligus</p>
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
        // Ambil ID User dari Laravel Blade
        const userId = "{{ Auth::id() }}"; 
        const storageKey = `property_draft_${userId}`; // Kunci unik: property_draft_1, property_draft_5, dst.

        // 1. Fungsi Simpan Draft (Gunakan key yang dinamis)
        function saveDraft() {
            const formData = {
                description: document.querySelector('[name="description"]').value,
                price: document.querySelector('[name="price"]').value,
                location: document.querySelector('[name="location"]').value,
                latitude: document.querySelector('[name="latitude"]').value,
                longitude: document.querySelector('[name="longitude"]').value,
                specifications: document.querySelector('[name="specifications"]').value,
                area: document.querySelector('[name="area"]').value,
                category: document.querySelector('[name="category"]').value,
            };
            localStorage.setItem(storageKey, JSON.stringify(formData)); // Simpan ke kunci milik user ini
        }
        
        // 2. Fungsi Load Draft
        document.addEventListener('DOMContentLoaded', function() {
            const savedData = localStorage.getItem(storageKey); // Hanya ambil data milik user ini
            
            if (savedData) {
                const data = JSON.parse(savedData);
                
                if(data.description) document.querySelector('[name="description"]').value = data.description;
                if(data.price) document.querySelector('[name="price"]').value = data.price;
                if(data.location) document.querySelector('[name="location"]').value = data.location;
                if(data.latitude) document.querySelector('[name="latitude"]').value = data.latitude;
                if(data.longitude) document.querySelector('[name="longitude"]').value = data.longitude;
                if(data.specifications) document.querySelector('[name="specifications"]').value = data.specifications;
                if(data.area) document.querySelector('[name="area"]').value = data.area;
                if(data.category) document.querySelector('[name="category"]').value = data.category;
            }

            const inputs = document.querySelectorAll('input[type="text"], input[type="number"], textarea, select');
            inputs.forEach(input => {
                input.addEventListener('input', saveDraft);
                input.addEventListener('change', saveDraft);
            });
        });
        
        // 3. Hapus Draft Setelah Submit Berhasil
        document.querySelector('form').addEventListener('submit', function() {
            localStorage.removeItem(storageKey);
        });


        // Update nama file saat upload
        document.getElementById('upload-doc').addEventListener('change', function(e) {
            document.getElementById('doc-name').textContent = e.target.files[0].name;
        });
        document.getElementById('upload-img').addEventListener('change', function(e) {
            document.getElementById('img-name').textContent = e.target.files[0].name;
        });
        document.getElementById('upload-img').addEventListener('change', function(e) {
            document.getElementById('img-name').textContent = e.target.files[0].name;
        });

        // TAMBAHAN: Script update nama file galeri
        document.getElementById('upload-gallery').addEventListener('change', function(e) {
            const count = e.target.files.length;
            document.getElementById('gallery-count').textContent = count + " foto dipilih";
        });
    </script>

</body>
</html>