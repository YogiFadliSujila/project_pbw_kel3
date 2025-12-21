<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LandHub - Temukan Lahan Impianmu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Custom Scrollbar hide */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none;  scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#F8F9FE] text-[#1E2B58]">

    <nav class="w-full py-6 px-6 md:px-12 flex justify-between items-center max-w-7xl mx-auto">
        <div class="text-2xl font-extrabold tracking-tight">
            LandHub
        </div>

        <div class="flex items-center gap-8">
            <a href="#" class="font-medium hover:text-blue-600 transition">Home</a>
            <a href="#" class="font-medium hover:text-blue-600 transition">About Us</a>
            
            @if(Route::has('login'))
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
            @endif

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

                // Opsional: Tutup pop-up jika klik di luar area
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

    <header class="px-6 md:px-12 max-w-7xl mx-auto mt-8 mb-16">
        <div class="flex flex-col md:flex-row justify-between items-start gap-10">
            <div class="md:w-1/2 pt-10">
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4">
                    Temukan Lahan <br> Impianmu <br> di LandHub
                </h1>
                <p class="text-sm text-gray-500 mb-8 max-w-md leading-relaxed">
                    Platform Digital Penjualan dan Pencarian Lahan yang mempertemukan penjual dan pembeli lahan secara transparan, mudah, dan aman.
                </p>
                <div class="flex gap-4">
                    <a href="{{ route('listing.index') }}" class="inline-block px-6 py-3 bg-[#1E2B58] text-white font-bold rounded-lg shadow-lg hover:bg-blue-900 transition">
                        Temukan Lahan &gt;
                    </a>
                    <a href="{{ route('properties.create') }}" class="inline-block px-6 py-3 bg-[#1E2B58] text-white font-bold rounded-lg shadow-lg hover:bg-blue-900 transition">
                        Pasang Iklan &gt;
                    </a>
                </div>
            </div>

            <div class="md:w-1/2 flex justify-end pt-10">
                 <svg width="375" height="270" viewBox="16 50 200 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25 122 V 83 L 70 40 L 115 79" stroke="#1E2B58" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                    <text x="50" y="115" font-family="'Inter', sans-serif" font-weight="800" font-size="38" fill="#1E2B58">LandHub</text>
                    <text x="135" y="135" font-family="'Inter', sans-serif" font-weight="500" font-size="12" letter-spacing="0.2em" fill="#586486">Property</text>
                </svg>
            </div>
        </div>
    </header>

    <section class="px-6 md:px-12 max-w-7xl mx-auto mb-16 text-center">
        <h3 class="font-bold text-lg mb-1">Promo Periode 2025</h3>
        <p class="text-xs text-gray-500 mb-6">Lahan terbaik dengan harga terjangkau siap jadi milik kamu</p>
        
        <div class="w-full rounded-3xl overflow-hidden shadow-xl bg-blue-100 relative group">
            <img src="{{ asset('storage/promo/promo.png') }}" alt="Promo Banner" class="w-full h-64 md:h-80 object-cover object-center group-hover:scale-105 transition duration-500">

        </div>
        <div class="flex justify-center gap-2 mt-4">
            <div class="w-2 h-2 rounded-full bg-gray-800"></div>
            <div class="w-2 h-2 rounded-full bg-gray-300"></div>
        </div>
    </section>

    <section class="px-6 md:px-12 max-w-4xl mx-auto mb-16">
        <div class="relative">
            <input type="text" placeholder="Cari Lahan Impianmu..." class="w-full py-4 pl-8 pr-16 rounded-full bg-[#EAF0F6] border-none focus:ring-2 focus:ring-blue-300 shadow-sm text-gray-700">
            <button class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            </button>
        </div>
    </section>

    <section class="px-6 md:px-12 max-w-7xl mx-auto mb-20">
        <div class="text-center mb-10">
            <h3 class="font-bold text-lg mb-1">Rekomendasi</h3>
            <p class="text-xs text-gray-500">Lahan terbaik hanya untuk kamu, segera amankan</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($properties as $prop)
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="rounded-xl overflow-hidden mb-4 relative h-48">
                    <img
                        src="{{ is_array($prop) ? $prop['image'] : ($prop->image ? asset(ltrim($prop->image, '/')) : '') }}"
                        alt="{{ is_array($prop) ? $prop['title'] : ($prop->title ?? '') }}"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500"
                    >
                    <div class="absolute bottom-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded shadow-md uppercase">For Sale</div>
                </div>
                
                <div class="flex justify-between items-end mb-2">
                    <div>
                        <h4 class="text-xl font-bold text-[#1E2B58]">Rp {{ $prop['price'] }}</h4>
                        <p class="text-sm font-bold text-gray-800">{{ $prop['title'] }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-bold text-gray-600">Luas Tanah: {{ $prop['area'] }} m</p>
                    </div>
                </div>
                
                <p class="text-xs text-gray-400 mb-4">{{ $prop['location'] }}</p>
                
                <a href="#" class="text-sm font-bold text-blue-600 hover:underline">Detail Lahan</a>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-8">
            <button class="px-8 py-2 bg-blue-100 text-blue-800 font-bold rounded-full hover:bg-blue-200 transition text-sm">
                See all >
            </button>
        </div>
    </section>

    <section class="px-6 md:px-12 max-w-7xl mx-auto mb-20">
        <div class="text-center mb-10">
            <h3 class="font-bold text-lg mb-1">Kelebihan</h3>
            <p class="text-xs text-gray-500">Mengapa LandHub dan bagaimana Platformnya</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <div class="bg-blue-50 w-full h-32 rounded-xl mb-4 flex items-center justify-center overflow-hidden">
                    <img src="https://cdn-icons-png.flaticon.com/512/2942/2942544.png" class="h-20 opacity-80" alt="Icon">
                </div>
                <p class="text-xs text-gray-600 font-medium px-4">Menyediakan fitur simulasi lahan dan property</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <div class="bg-blue-50 w-full h-32 rounded-xl mb-4 flex items-center justify-center overflow-hidden">
                    <img src="https://cdn-icons-png.flaticon.com/512/1000/1000997.png" class="h-20 opacity-80" alt="Icon">
                </div>
                <p class="text-xs text-gray-600 font-medium px-4">Penjual dan pencari lahan bernegosiasi tanpa tatap muka</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <div class="bg-blue-50 w-full h-32 rounded-xl mb-4 flex items-center justify-center overflow-hidden">
                     <img src="https://cdn-icons-png.flaticon.com/512/1534/1534193.png" class="h-20 opacity-80" alt="Icon">
                </div>
                <p class="text-xs text-gray-600 font-medium px-4">Menjamin legalitas lahan dan property</p>
            </div>

             <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <div class="bg-blue-50 w-full h-32 rounded-xl mb-4 flex items-center justify-center overflow-hidden">
                    <img src="https://cdn-icons-png.flaticon.com/512/2534/2534204.png" class="h-20 opacity-80" alt="Icon">
                </div>
                <p class="text-xs text-gray-600 font-medium px-4">Menyediakan fitur transaksi secara online</p>
            </div>

             <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <div class="bg-blue-50 w-full h-32 rounded-xl mb-4 flex items-center justify-center overflow-hidden">
                    <img src="https://cdn-icons-png.flaticon.com/512/2037/2037061.png" class="h-20 opacity-80" alt="Icon">
                </div>
                <p class="text-xs text-gray-600 font-medium px-4">Menyediakan fitur pasang iklan lahan agar cepat terjual</p>
            </div>

             <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <div class="bg-blue-50 w-full h-32 rounded-xl mb-4 flex items-center justify-center overflow-hidden">
                    <img src="https://cdn-icons-png.flaticon.com/512/4205/4205906.png" class="h-20 opacity-80" alt="Icon">
                </div>
                <p class="text-xs text-gray-600 font-medium px-4">Untuk meyakinkan penjual kami terintegrasi dengan Google Maps</p>
            </div>
        </div>
    </section>

    <section class="px-6 md:px-12 max-w-7xl mx-auto mb-24">
        <div class="text-center mb-10">
            <h3 class="font-bold text-lg mb-1">Ulasan</h3>
            <p class="text-xs text-gray-500">Kata mereka tentang LandHub</p>
        </div>

        <div class="flex flex-col md:flex-row gap-6">
            <div class="flex-1 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                <div class="w-10 h-10 rounded-full bg-purple-100 flex-shrink-0"></div>
                <div>
                    <h5 class="font-bold text-sm">Tatang Kurniawan</h5>
                    <p class="text-xs text-gray-400 mb-2">Penjual Lahan</p>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Platform ini membantu saya menjual lahan yang sudah 1 tahun lamanya tidak terjual, dengan bantuan fitur pasang iklan menjadikan lahan saya cepat terjual.
                    </p>
                </div>
            </div>

             <div class="flex-1 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                <div class="w-10 h-10 rounded-full bg-pink-100 flex-shrink-0"></div>
                <div>
                    <h5 class="font-bold text-sm">Zaskia Zivara Cellista</h5>
                    <p class="text-xs text-gray-400 mb-2">Pencari Lahan</p>
                    <p class="text-xs text-gray-600 leading-relaxed">
                       Saya sangat terbantu dengan adanya platform ini. Bisa mencari lahan dengan legalitas yang jelas dan transaksi yang aman.
                    </p>
                </div>
            </div>

             <div class="flex-1 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex-shrink-0"></div>
                <div>
                    <h5 class="font-bold text-sm">Rahmat Hasanuddin</h5>
                    <p class="text-xs text-gray-400 mb-2">Pencari Lahan</p>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Platform ini menyediakan fitur negosiasi yang sangat membantu bagi orang seperti saya yang mempunyai budget pas.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="flex justify-center gap-2 mt-6">
            <div class="w-1.5 h-1.5 rounded-full bg-gray-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-gray-300"></div>
        </div>
    </section>

    <footer class="bg-white border-t border-gray-200 py-12">
        <div class="px-6 md:px-12 max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start gap-8">
            <div>
                <h2 class="text-2xl font-extrabold text-[#1E2B58] mb-2">LandHub</h2>
                <p class="text-xs text-gray-500 max-w-xs">
                    Temukan lahan impianmu di LandHub.
                </p>
                <p class="text-[10px] text-gray-400 mt-8">
                    © LandHub 2025 - by pbw kel 3 <span class="text-red-500">♥</span>
                </p>
            </div>

            <div>
                <h4 class="font-bold text-sm mb-4">Tentang Kami</h4>
                <ul class="space-y-2 text-xs text-gray-500">
                    <li><a href="#" class="hover:text-blue-600">Mahasiswa Informatika</a></li>
                    <li><a href="#" class="hover:text-blue-600">Universitas Sebelas April</a></li>
                </ul>
            </div>

             <div>
                <h4 class="font-bold text-sm mb-4">Hubungi Kami</h4>
                <ul class="space-y-2 text-xs text-gray-500">
                    <li>info@landhub.com</li>
                    <li>+62 81234567890</li>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>