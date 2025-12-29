<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temukan Lahan - LandHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-[#F8F9FE] text-[#1E2B58]">

    <nav class="w-full py-6 px-6 md:px-12 flex justify-between items-center max-w-7xl mx-auto">
        <a href="{{ route('landing') }}" class="text-2xl font-extrabold tracking-tight hover:opacity-80 transition">
            LandHub
        </a>

        <div class="flex items-center gap-8">
            <a href="{{ route('landing') }}" class="font-medium hover:text-blue-600 transition">Home</a>
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
                                <a href="{{route('profil')}}" class="flex items-center justify-between w-full p-4 bg-[#EEF2FF] rounded-xl text-[#1E2B58] font-bold hover:bg-blue-100 transition group">
                                    <span>Profil</span>
                                    <svg class="w-5 h-5 text-black group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                    
                                <a href="{{ route('chat.index') }}" class="flex items-center justify-between w-full p-4 bg-[#EEF2FF] rounded-xl text-[#1E2B58] font-bold hover:bg-blue-100 transition group">
                                    <div class="flex items-center gap-3">
                                        <span>Pesan</span>
                                        @php
                                            $unreadCount = \App\Models\Message::whereHas('conversation', function($q) {
                                                $q->where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id());
                                            })->where('user_id', '!=', Auth::id())->where('is_read', false)->count();
                                        @endphp
                                        @if($unreadCount > 0)
                                            <span class="bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full ml-2">{{ $unreadCount }}</span>
                                        @endif
                                    </div>
                                    <svg class="w-5 h-5 text-black group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                                <a href="{{route('landing')}}#Rekomendasi" class="flex items-center justify-between w-full p-4 bg-[#EEF2FF] rounded-xl text-[#1E2B58] font-bold hover:bg-blue-100 transition group">
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

    <section class="px-6 md:px-12 max-w-4xl mx-auto mb-16">
        <form action="{{ route('listing.index') }}" method="GET" class="relative">
            
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Cari Lahan Impianmu..." 
                class="w-full py-4 pl-8 pr-16 rounded-full bg-[#EAF0F6] border-none focus:ring-2 focus:ring-blue-300 shadow-sm text-gray-700"
            >
            
            <button type="button" onclick="toggleFilterModal()" class="absolute right-6 transform translate-y-4 text-gray-500 hover:text-gray-800">
                <span class="material-icons">tune</span> </button>
            </button>            
        </form>
    </section>
    <x-filter-modal />

    <div class="text-center mb-12">
        <h1 class="text-2xl md:text-3xl font-bold text-[#1E2B58] mb-2">Temukan Lahan Impianmu</h1>
        <p class="text-xs md:text-sm text-gray-500">Tempat yang strategis dengan harga minimalis</p>
    </div>

    <section class="px-6 md:px-12 max-w-7xl mx-auto mb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-10">
            
            @forelse($properties as $prop)
            <a href="{{ route('property.show', $prop->id) }}" class="group block no-underline">
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="rounded-xl overflow-hidden mb-4 relative h-64 w-full">
                    <img 
                        src="{{asset(ltrim($prop->image, '/'))}}" 
                        alt="{{ $prop->title }}" 
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500"
                    >
                    @if($prop->priority_level == 1) 
                        <div class="absolute top-4 left-4 z-10">
                            <div class="bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1 border border-yellow-200">
                                <span class="material-icons text-[14px]">workspace_premium</span>
                                <span>GOLD</span>
                            </div>
                            <div class="absolute inset-0 bg-white opacity-20 blur-sm rounded-full animate-pulse"></div>
                        </div>

                    @elseif($prop->priority_level == 2)
                        <div class="absolute top-4 left-4 z-10">
                            <div class="bg-gradient-to-r from-gray-400 to-gray-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg flex items-center gap-1 border border-gray-300">
                                <span class="material-icons text-[14px]">verified</span>
                                <span>SILVER</span>
                            </div>
                        </div>

                    @else
                        @endif
                </div>
                
                <div class="flex justify-between items-top mb-1">
                    <h4 class="text-xl font-bold text-[#1E2B58]">
                        Rp {{ number_format($prop->price, 0, ',', '.') }}
                    </h4>
                    <p class="text-xs font-bold text-gray-800">Luas Tanah: {{ $prop->area ?? '-' }} m²</p>
                </div>
                
                <h5 class="font-bold text-black text-sm mb-2">{{ $prop->description }}</h5>
                
                <p class="text-[10px] text-gray-500 mb-4 leading-relaxed line-clamp-2">
                    {{ $prop->location ?? 'Lokasi tidak tersedia' }}
                </p>
                
                <span class="text-xs font-bold text-blue-700 group-hover:underline">Detail Lahan</span>
            </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-20">
                <h3 class="text-xl font-bold text-gray-700">Tidak ditemukan</h3>
                <p class="text-gray-500">
                    Maaf, kami tidak menemukan properti dengan kata kunci 
                    <span class="font-bold">"{{ request('search') }}"</span>.
                </p>
                <a href="{{ route('listing.index') }}" class="inline-block mt-4 text-blue-600 font-bold hover:underline">
                    Lihat Semua Properti
                </a>
            </div>
            @endforelse

        </div>
    </section>

    <div class="mt-8">
        {{ $properties->withQueryString()->links() }}
    </div>

    <footer class="bg-white border-t border-gray-200 py-12 mt-auto">
        <div class="px-6 md:px-12 max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start gap-8">
            <div>
                <h2 class="text-2xl font-extrabold text-[#1E2B58] mb-2">LandHub</h2>
                <p class="text-xs text-gray-500 max-w-xs mb-8">
                    Temukan lahan impianmu di LandHub.
                </p>
                <p class="text-[10px] text-gray-400">
                    © LandHub 2025 - by pbw kel 3 <span class="text-red-500">♥</span>
                </p>
            </div>

            <div>
                <h4 class="font-bold text-sm mb-4">Tentang Kami :</h4>
                <ul class="space-y-2 text-xs text-gray-500">
                    <li>Mahasiswa Informatika</li>
                    <li>Universitas Sebelas April</li>
                </ul>
            </div>

             <div>
                <h4 class="font-bold text-sm mb-4">Hubungi Kami :</h4>
                <ul class="space-y-2 text-xs text-gray-500">
                    <li>info@landhub.com</li>
                    <li>+62 81234567890</li>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>