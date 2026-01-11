<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LandHub - Temukan Lahan Impianmu</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
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

        <div class="flex items-center gap-6">
            <a href="{{route('landing')}}" class="font-medium hover:text-blue-600 transition">Home</a>
            <a href="{{ route('about') }}" class="font-medium hover:text-blue-600 transition">About Us</a>
            
            {{-- Notification bell for logged in users (buyers) --}}
            @auth
            <div class="relative">
                <button id="notifToggle" class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-gray-700 border border-gray-200 shadow-sm hover:shadow-md transition">
                    <span class="material-icons">notifications</span>
                    @if(isset($notifications) && $notifications->count() > 0)
                        <span class="notif-count absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full">{{ $notifications->count() }}</span>
                    @endif
                </button>

                <div id="notifDropdown" class="hidden absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden z-50">
                    <div class="p-4 border-b border-gray-100 flex items-center gap-3">
                        <img src="/storage/assets/g1.png" alt="logo" class="w-10 h-10 rounded-lg">
                        <div>
                            <div class="text-sm font-bold">Notifikasi</div>
                            <div class="text-xs text-gray-500">Pemberitahuan terbaru</div>
                        </div>
                    </div>
                    <div class="max-h-64 overflow-auto">
                        @if(isset($notifications) && $notifications->count() > 0)
                            @foreach($notifications as $note)
                                @php $data = (array) $note->data; @endphp
                                <a href="{{ $data['link'] ?? '#' }}" class="block p-3 hover:bg-gray-50 border-b border-gray-100 flex items-start gap-3">
                                    <img src="/storage/assets/g4.png" alt="icon" class="w-8 h-8 rounded-md object-cover">
                                    <div class="flex-1 text-sm">
                                        <div class="font-semibold text-gray-800">{{ $data['message'] ?? 'Ada pembaruan pada tiket Anda' }}</div>
                                        <div class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($note->created_at)->diffForHumans() }}</div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="p-4 text-sm text-gray-500">Tidak ada notifikasi.</div>
                        @endif
                    </div>
                    <div class="p-3 text-center bg-gray-50">
                        <a href="{{ route('profil') }}" class="text-sm text-blue-600 font-medium">Lihat semua</a>
                    </div>
                </div>
            </div>
            @endauth
            
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
                                <a href="#Rekomendasi" class="flex items-center justify-between w-full p-4 bg-[#EEF2FF] rounded-xl text-[#1E2B58] font-bold hover:bg-blue-100 transition group">
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
                        popup.classList.add('opacity-100', 'translate-y-0');
                        popup.classList.remove('opacity-0', '-translate-y-2');
                    } else {
                        popup.classList.add('hidden');
                    }
                }
                document.addEventListener('click', function(event) {
                    const popup = document.getElementById('profilePopup');
                    const trigger = document.querySelector('button[onclick="toggleProfilePopup()"]');
                    const isClickInside = popup && (popup.contains(event.target) || (trigger && trigger.contains(event.target)));
                    if (!isClickInside && popup && !popup.classList.contains('hidden')) {
                        popup.classList.add('hidden');
                    }
                });
                // Notification dropdown toggle
                document.addEventListener('DOMContentLoaded', function() {
                    const btn = document.getElementById('notifToggle');
                    const dd = document.getElementById('notifDropdown');
                    const markReadUrl = "{{ route('notifications.markRead') }}";

                    if (btn && dd) {
                        btn.addEventListener('click', function(e) {
                            e.stopPropagation();

                            const wasHidden = dd.classList.contains('hidden');
                            dd.classList.toggle('hidden');

                            // Jika dropdown baru dibuka, tandai notifikasi sebagai dibaca
                            if (wasHidden && !dd.classList.contains('hidden')) {
                                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                                fetch(markReadUrl, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json',
                                        'X-CSRF-TOKEN': token
                                    },
                                    body: JSON.stringify({})
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        document.querySelectorAll('.notif-count').forEach(el => el.remove());
                                    }
                                })
                                .catch(() => {
                                    // silent fail
                                });
                            }
                        });

                        document.addEventListener('click', function(ev) {
                            if (!dd.classList.contains('hidden')) dd.classList.add('hidden');
                        });
                    }
                });
            </script>
        </div>
    </nav>

    <header class="px-6 md:px-12 max-w-7xl items-center mx-auto mt-8 mb-16 h-[60vh]">
        <div class="flex flex-col md:flex-row justify-between items-center gap-10">
            <div class="md:w-1/2 pt-10">
                <h1 class="text-7xl md:text-5xl font-extrabold leading-tight mb-4">
                    Temukan Lahan <br> Impianmu <br> di LandHub
                </h1>
                <p class="text-base text-gray-500 mb-8 max-w-md leading-relaxed">
                    Platform Digital Penjualan dan Pencarian Lahan yang mempertemukan penjual dan pembeli lahan secara transparan, mudah, dan aman.
                </p>
                <div class="gap-4 flex">
                    <a href="{{ route('listing.index') }}" class="flex px-6 py-3 bg-[#1E2B58] text-white font-bold rounded-lg shadow-lg hover:bg-blue-900 transition">
                        <span class="mr-3">Temukan Lahan</span>
                        <Span>→</Span>
                    </a>
                    <a href="{{ route('properties.create') }}" class="flex px-6 py-3 border-2 border-[#1E2B58] text-[#1E2B58] font-bold rounded-lg hover:bg-[#1E2B58] hover:text-white transition">
                        <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                        </svg>
                        <span>Pasang Iklan</span>
                    </a>
                </div>
            </div>

            <div class="md:w-1/2 flex justify-end pt-10">
                 <svg width="375" height="270" viewBox="16 50 200 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M25 120 V 83 L 67 44 L 108 78" stroke="#1E2B58" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                    <text x="47" y="115" font-family="'Inter', sans-serif" font-weight="800" font-size="38" fill="#1E2B58">LandHub</text>
                    <text x="145" y="135" font-family="'Inter', sans-serif" font-weight="500" font-size="12" letter-spacing="0.2em" fill="#586486">Property</text>
                </svg>
            </div>
        </div>
    </header>

    <section class="px-6 md:px-12 max-w-7xl mx-auto mb-16 text-center">
        <h3 class="font-bold text-xl mb-1">Promo Periode 2025</h3>
        <p class="text-base text-gray-500 mb-6">Lahan terbaik dengan harga terjangkau siap jadi milik kamu</p>
        
        @php
            $promoImages = [
                'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=1200&q=80', 
                'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80', 
                'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=1200&q=80',
            ];
        @endphp

        <section class="px-6 md:px-12 max-w-7xl mx-auto mb-12">
            <div class="relative w-full group">
                <div class="w-full rounded-3xl overflow-hidden shadow-xl bg-blue-100 relative h-64 md:h-80">
                    <div id="slider-track" class="flex h-full transition-transform duration-700 ease-in-out transform">
                        @foreach($promoImages as $index => $image)
                            <div class="w-full h-full flex-shrink-0 relative">
                                <img src="{{ $image }}" alt="Promo {{ $index + 1 }}" class="w-full h-full object-cover object-center">
                                <div class="absolute inset-0 "></div>
                                <div class="absolute bottom-6 left-6 text-white">
                                    <h3 class="text-2xl font-bold">Promo Spesial #{{ $index + 1 }}</h3>
                                    <p class="text-sm opacity-90">Diskon admin fee hingga 50%!</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-center gap-2 mt-4">
                    @foreach($promoImages as $index => $image)
                        <button onclick="goToSlide({{ $index }})" class="slider-dot w-2 h-2 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-gray-800 w-6' : 'bg-gray-300' }}"></button>
                    @endforeach
                </div>
            </div>
        </section>
    </section>

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

    <section class="px-6 md:px-12 max-w-7xl mx-auto mb-20">
        <div class="text-center mb-10">
            <h3 id = "Rekomendasi" class="font-bold text-xl mb-1">Rekomendasi</h3>
            <p class="text-base text-gray-500">Lahan terbaik hanya untuk kamu, segera amankan</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($properties as $prop)

            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition">
                <a href="{{ route('property.show', $prop->id)}}">
                <div class="rounded-xl overflow-hidden mb-4 relative h-48 group">
                    <img
                        src="{{ $prop->image ? asset(ltrim($prop->image, '/')) : '' }}"
                        alt="{{ $prop->title }}"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500"
                    >
                    
                    {{-- [FASE 4] VISUAL BADGE START --}}
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
                    @endif
                    {{-- [FASE 4] VISUAL BADGE END --}}

                    <div class="absolute bottom-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded shadow-md uppercase">For Sale</div>
                </div>
                
                <div class="flex justify-between items-center">
                    <div>
                        @php
                            $price = $prop->price;
                                if ($price >= 1_000_000_000) {
                                    $priceFormatted = number_format($price / 1_000_000_000, 2, ',', '.') . ' M';
                                } elseif ($price >= 1_000_000) {
                                    $priceFormatted = number_format($price / 1_000_000, 2, ',', '.') . ' Jt';
                                } else {
                                    $priceFormatted = number_format($priceFormatted);
                                }
                        @endphp
                        <h4 class="text-lg font-bold text-[#1E2B58]">Rp {{ $priceFormatted }}</h4>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-bold text-gray-600">Luas: {{ $prop->area }} m²</p>
                    </div>
                </div>
                <p class="text-xs font-bold text-gray-800 truncate max-w-[150px]">{{ $prop->description }}</p>
                <p class="text-xs text-gray-400 truncate">{{ $prop->location }}</p>
                <a href="{{ route('property.show', $prop->id) }}" class="text-xs font-bold text-blue-600 hover:underline">Detail Lahan</a>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-8">
            <a href="{{ route('listing.index') }}" class="inline-block px-8 py-2 bg-blue-100 text-blue-800 font-bold rounded-full hover:bg-blue-200 transition text-sm">
                See all &gt;
            </a>
        </div>
    </section>

    <section class="px-6 md:px-12 max-w-7xl mx-auto mb-20">
        <div class="text-center mb-10">
            <h3 class="font-bold text-xl mb-1">Kelebihan</h3>
            <p class="text-base text-gray-500">Mengapa LandHub dan bagaimana Platformnya</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <div >
                    <img src="storage/assets/g1.png" class="w-full h-full opacity-100 rounded-xl mb-4 flex items-center justify-center overflow-hidden" alt="Icon">
                </div>
                <p class="text-sm text-gray-600 font-medium px-4">Menyediakan fitur simulasi lahan dan property</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <div >
                    <img src="storage/assets/g2.png" class="w-full h-full opacity-100 rounded-xl mb-4 flex items-center justify-center overflow-hidden" alt="Icon">
                </div>
                <p class="text-sm text-gray-600 font-medium px-4">Penjual dan pencari lahan bernegosiasi tanpa tatap muka</p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <div >
                     <img src="storage/assets/g3.png" class="w-full h-full opacity-100 rounded-xl mb-4 flex items-center justify-center overflow-hidden" alt="Icon">
                </div>
                <p class="text-sm text-gray-600 font-medium px-4">Menjamin legalitas lahan dan property</p>
            </div>

             <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <div >
                    <img src="storage/assets/g4.png" class="w-full h-full opacity-100 rounded-xl mb-4 flex items-center justify-center overflow-hidden" alt="Icon">
                </div>
                <p class="text-sm text-gray-600 font-medium px-4">Menyediakan fitur transaksi secara online</p>
            </div>

             <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <div>
                    <img src="storage/assets/g5.png" class="w-full h-full opacity-100 rounded-xl mb-4 flex items-center justify-center overflow-hidden" alt="Icon">
                </div>
                <p class="text-sm text-gray-600 font-medium px-4">Menyediakan fitur pasang iklan lahan agar cepat terjual</p>
            </div>

             <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                <div>
                    <img src="storage/assets/g6.png" class="w-full h-full opacity-100 rounded-xl mb-4 flex items-center justify-center overflow-hidden" alt="Icon">
                </div>
                <p class="text-sm text-gray-600 font-medium px-4">Untuk meyakinkan penjual kami terintegrasi dengan Google Maps</p>
            </div>
        </div>
    </section>

    <section class="px-6 md:px-12 max-w-7xl mx-auto mb-24">
        <div class="text-center mb-10">
            <h3 class="font-bold text-lg mb-1">Ulasan</h3>
            <p class="text-sm text-gray-500">Kata mereka tentang LandHub</p>
        </div>
<<<<<<< HEAD

        <div class="flex flex-col md:flex-row gap-6">
            <div class="flex-1 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                <div class="w-10 h-10 rounded-full bg-purple-100 flex-shrink-0"></div>
                <div>
                    <h5 class="font-bold text-sm">Tatang Kurniawan</h5>
                    <p class="text-sm text-gray-400 mb-2">Penjual Lahan</p>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Platform ini membantu saya menjual lahan yang sudah 1 tahun lamanya tidak terjual, dengan bantuan fitur pasang iklan menjadikan lahan saya cepat terjual.
                    </p>
                </div>
            </div>

             <div class="flex-1 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                <div class="w-10 h-10 rounded-full bg-pink-100 flex-shrink-0"></div>
                <div>
                    <h5 class="font-bold text-sm">Zaskia Zivara Cellista</h5>
                    <p class="text-sm text-gray-400 mb-2">Pencari Lahan</p>
                    <p class="text-sm text-gray-600 leading-relaxed">
                       Saya sangat terbantu dengan adanya platform ini. Bisa mencari lahan dengan legalitas yang jelas dan transaksi yang aman.
                    </p>
                </div>
            </div>

             <div class="flex-1 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                <div class="w-10 h-10 rounded-full bg-blue-100 flex-shrink-0"></div>
                <div>
                    <h5 class="font-bold text-sm">Rahmat Hasanuddin</h5>
                    <p class="text-sm text-gray-400 mb-2">Pencari Lahan</p>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Platform ini menyediakan fitur negosiasi yang sangat membantu bagi orang seperti saya yang mempunyai budget pas.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="flex justify-center gap-2 mt-6">
            <div class="w-1.5 h-1.5 rounded-full bg-gray-800"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-gray-300"></div>
=======
        <div class="max-w-4xl mx-auto mb-6">
            <div class="mb-6">
                <form id="reviewForm" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h4 class="font-bold mb-3">Tambahkan Ulasan</h4>
                    @auth
                        <p class="text-sm text-gray-500 mb-3">Anda masuk sebagai <strong>{{ Auth::user()->name }}</strong>. Ulasan akan terkait ke akun Anda.</p>
                    @endauth

                    @guest
                        <div class="mb-3">
                            <label class="text-xs text-gray-500">Nama</label>
                            <input type="text" name="guest_name" id="guest_name" class="w-full mt-1 p-2 border rounded" placeholder="Nama Anda">
                        </div>
                    @endguest

                    <div class="mb-3">
                        <label class="text-xs text-gray-500">Ulasan</label>
                        <textarea name="body" id="review_body" rows="3" class="w-full mt-1 p-2 border rounded" placeholder="Tulis pengalaman Anda..." required></textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <div>
                            <label class="text-xs text-gray-500 mr-2">Rating</label>
                            <select name="rating" id="review_rating" class="p-1 border rounded text-sm">
                                <option value="">(opsional)</option>
                                <option value="5">5 — Sangat Baik</option>
                                <option value="4">4 — Baik</option>
                                <option value="3">3 — Cukup</option>
                                <option value="2">2 — Kurang</option>
                                <option value="1">1 — Buruk</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded font-bold">Kirim Ulasan</button>
                        </div>
                    </div>

                    <div id="reviewErrors" class="text-sm text-red-600 mt-3 hidden"></div>
                    <div id="reviewSuccess" class="text-sm text-green-600 mt-3 hidden">Ulasan terkirim.</div>
                </form>
            </div>

            <div id="reviewsList" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($reviews as $rv)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex-shrink-0 flex items-center justify-center text-sm font-bold text-gray-700">{{ strtoupper(substr($rv->user?->name ?? $rv->guest_name ?? 'G',0,1)) }}</div>
                    <div>
                        <h5 class="font-bold text-sm">{{ $rv->user?->name ?? $rv->guest_name ?? 'Guest' }}</h5>
                        @if($rv->rating)
                            <p class="text-xs text-yellow-600 font-semibold">Rating: {{ $rv->rating }} / 5</p>
                        @endif
                        <p class="text-sm text-gray-600 leading-relaxed mt-2">{{ $rv->body }}</p>
                        <p class="text-xs text-gray-400 mt-2">{{ $rv->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
            </div>
>>>>>>> origin/memperbaiki-landing
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

    @if(isset($popupProperty) && $popupProperty)
    <div id="promoModal" class="fixed inset-0 z-[999] flex items-center justify-center hidden opacity-0 transition-opacity duration-500">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closePromo()"></div>
        
        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-3xl mx-4 overflow-hidden flex flex-col md:flex-row transform scale-95 transition-transform duration-500" id="promoContent">
            
            <button onclick="closePromo()" class="absolute top-4 right-4 z-20 bg-white/80 hover:bg-white text-slate-800 rounded-full p-2 shadow-sm transition">
                <span class="material-icons">close</span>
            </button>

            <div class="w-full md:w-1/2 h-64 md:h-auto relative">
                <img src="{{ $popupProperty->image ? asset(ltrim($popupProperty->image, '/')) : '' }}" class="w-full h-full object-cover">
                <div class="absolute top-4 left-4 bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded shadow-md">
                    REKOMENDASI HARI INI
                </div>
            </div>

            <div class="w-full md:w-1/2 p-8 md:p-10 flex flex-col justify-center bg-gradient-to-br from-white to-yellow-50">
                <h4 class="text-yellow-600 font-bold tracking-widest text-xs uppercase mb-2">🔥 Hot Property (Gold)</h4>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-2 leading-tight">{{ $popupProperty->title }}</h2>
                <p class="text-slate-500 mb-6 line-clamp-2">{{ $popupProperty->description }}</p>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                            <span class="material-icons">location_on</span>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400">Lokasi</p>
                            <p class="font-bold text-slate-800">{{ $popupProperty->location }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-green-100 text-green-600 rounded-lg">
                            <span class="material-icons">payments</span>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400">Harga Penawaran</p>
                            <p class="font-bold text-slate-800 text-xl">Rp {{ number_format($popupProperty->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ route('property.show', $popupProperty->id) }}" class="block w-full py-3 bg-[#1E2B58] hover:bg-blue-900 text-white text-center font-bold rounded-xl shadow-lg transition transform hover:-translate-y-1">
                        Lihat Detail Properti
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cek apakah user sudah melihat promo sesi ini
            const hasSeenPromo = sessionStorage.getItem('seen_promo');
            
            if (!hasSeenPromo) {
                // Tampilkan Modal dengan delay sedikit agar smooth
                setTimeout(() => {
                    const modal = document.getElementById('promoModal');
                    const content = document.getElementById('promoContent');
                    
                    if(modal) {
                        modal.classList.remove('hidden');
                        // Trigger reflow agar transisi opacity jalan
                        void modal.offsetWidth; 
                        modal.classList.remove('opacity-0');
                        
                        content.classList.remove('scale-95');
                        content.classList.add('scale-100');
                        
                        // Tandai sudah melihat
                        sessionStorage.setItem('seen_promo', 'true');
                    }
                }, 1500); // Muncul setelah 1.5 detik
            }
        });

        function closePromo() {
            const modal = document.getElementById('promoModal');
            const content = document.getElementById('promoContent');
            
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 500);
        }

        // Konfigurasi
        const slideInterval = 5000; // Waktu pindah (ms) -> 5000 = 5 detik
        
        let currentSlide = 0;
        const totalSlides = {{ count($promoImages) }};
        const track = document.getElementById('slider-track');
        const dots = document.querySelectorAll('.slider-dot');
        let autoSlideTimer;

        // Fungsi Update Posisi Slider
        function updateSlider() {
            // Geser track
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
            
            // Update warna dots
            dots.forEach((dot, index) => {
                if (index === currentSlide) {
                    dot.classList.remove('bg-gray-300', 'w-2');
                    dot.classList.add('bg-gray-800', 'w-6'); // Active style (lebih panjang)
                } else {
                    dot.classList.remove('bg-gray-800', 'w-6');
                    dot.classList.add('bg-gray-300', 'w-2'); // Inactive style
                }
            });
        }

        // Fungsi Pindah ke Slide Berikutnya
        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        }

        // Fungsi Pindah Manual (Saat klik dot)
        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
            resetTimer(); // Reset waktu agar tidak langsung pindah lagi
        }

        // Fungsi Reset Timer (Agar user experience lebih halus)
        function resetTimer() {
            clearInterval(autoSlideTimer);
            autoSlideTimer = setInterval(nextSlide, slideInterval);
        }

        // Mulai Otomatis saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            resetTimer();
        });
    </script>
    @endif
<<<<<<< HEAD
=======
</body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reviewForm');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const url = "{{ route('reviews.store') }}";
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const body = document.getElementById('review_body').value.trim();
        const rating = document.getElementById('review_rating').value || null;
        const guestNameEl = document.getElementById('guest_name');
        const guest_name = guestNameEl ? guestNameEl.value.trim() : null;

        const payload = { body, rating };
        if (guest_name) payload.guest_name = guest_name;

        const errorsEl = document.getElementById('reviewErrors');
        const successEl = document.getElementById('reviewSuccess');
        errorsEl.classList.add('hidden');
        successEl.classList.add('hidden');

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        })
        .then(async (res) => {
            if (!res.ok) {
                const json = await res.json().catch(() => ({}));
                throw json;
            }
            return res.json();
        })
        .then(data => {
            if (data.success && data.review) {
                // append new review card
                const list = document.getElementById('reviewsList');
                const r = data.review;
                const card = document.createElement('div');
                card.className = 'bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4';
                card.innerHTML = `<div class="w-10 h-10 rounded-full bg-gray-100 flex-shrink-0 flex items-center justify-center text-sm font-bold text-gray-700">${(r.name||'G').charAt(0).toUpperCase()}</div>
                    <div>
                        <h5 class="font-bold text-sm">${r.name}</h5>
                        ${r.rating ? `<p class="text-xs text-yellow-600 font-semibold">Rating: ${r.rating} / 5</p>` : ''}
                        <p class="text-sm text-gray-600 leading-relaxed mt-2">${r.body}</p>
                        <p class="text-xs text-gray-400 mt-2">${r.created_at}</p>
                    </div>`;
                list.prepend(card);

                // reset form
                form.reset();
                successEl.classList.remove('hidden');
                setTimeout(() => successEl.classList.add('hidden'), 3000);
            }
        })
        .catch(err => {
            if (err && err.errors) {
                const msgs = Object.values(err.errors).flat().join(' ');
                errorsEl.textContent = msgs;
                errorsEl.classList.remove('hidden');
            } else {
                errorsEl.textContent = 'Terjadi kesalahan. Coba lagi.';
                errorsEl.classList.remove('hidden');
            }
        });
    });
});
</script>
>>>>>>> origin/memperbaiki-landing

</body>
</html>