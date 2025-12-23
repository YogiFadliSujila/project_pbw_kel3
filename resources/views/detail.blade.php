<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - LandHub</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#1e3a8a", 
                        secondary: "#2563eb", 
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                        "card-light": "#ffffff",
                        "card-dark": "#1e293b",
                        "search-light": "#e0e7ff",
                        "search-dark": "#1e293b",
                    },
                    fontFamily: {
                        sans: ["Poppins", "sans-serif"],
                    },
                },
            },
        };
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-background-light text-slate-800 transition-colors duration-300">

    <nav class="w-full py-4 px-6 md:px-12 flex justify-between items-center bg-transparent relative z-50">
        <div class="flex items-center">
            <a href="{{ route('landing') }}" class="text-2xl font-bold text-primary">LandHub</a>
        </div>
        
        <div class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-600">
            <a class="hover:text-primary transition" href="{{ route('landing') }}">Home</a>
            <a class="hover:text-primary transition" href="#">About Us</a>
            
            @auth
                <div class="relative">
                    <button onclick="toggleProfilePopup()" class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-800 font-bold border-2 border-transparent hover:border-blue-300 transition focus:outline-none">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </button>

                    <div id="profilePopup" class="hidden absolute right-0 top-14 w-80 bg-white rounded-3xl shadow-xl border border-gray-100 p-6 z-50 transform origin-top-right transition-all duration-200">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-full bg-[#F3E8FF] border-2 border-[#7E22CE] flex items-center justify-center text-[#7E22CE]">
                                    <span class="material-icons-outlined text-3xl">person</span>
                                </div>
                                <h4 class="font-bold text-lg text-black">{{ Auth::user()->name }}</h4>
                            </div>
                            <button onclick="toggleProfilePopup()" class="text-black hover:text-gray-500">
                                <span class="material-icons-outlined">close</span>
                            </button>
                        </div>
                        <div class="h-px w-full bg-[#E9D5FF] mb-6"></div>
                        <div class="space-y-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 w-full p-4 bg-[#EEF2FF] rounded-xl text-[#1E2B58] font-bold hover:bg-red-50 hover:text-red-600 transition w-full text-left">
                                    <span class="material-icons-outlined">logout</span>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-300">
                    <span class="material-icons-outlined">person</span>
                </a>
            @endauth
        </div>
    </nav>

    <section class="w-full px-6 flex justify-center mb-10 mt-4">
        <div class="relative w-full max-w-3xl">
            <div class="bg-search-light rounded-full px-6 py-3 flex items-center justify-between shadow-sm">
                <input class="bg-transparent border-none focus:ring-0 w-full text-slate-700 placeholder-slate-500 text-sm" placeholder="Cari Lahan Impianmu..." type="text"/>
                <button class="text-slate-600 hover:text-primary">
                    <span class="material-icons-outlined">search</span>
                </button>
            </div>
        </div>
    </section>

    <div class="text-center mb-12">
        <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Deskripsi Lahan</h2>
        <p class="text-slate-500 mt-2">Jelajahi detail property impian mu</p>
    </div>

    <main class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1 lg:grid-cols-12 gap-12 pb-20">
        
        <div class="lg:col-span-7 space-y-8">
            <div>
                <h1 class="text-2xl md:text-4xl font-bold text-slate-900 leading-tight mb-3">
                    {{ $property->title }}
                </h1>
                <h2 class="text-2xl md:text-3xl font-bold text-primary mb-2">
                    Rp {{ number_format($property->price, 0, ',', '.') }}
                </h2>
                <p class="text-slate-500 text-sm mb-2 flex items-center gap-1">
                    <span class="material-icons-outlined text-sm">location_on</span>
                    {{ $property->location ?? 'Lokasi belum diatur' }}
                </p>
                <p class="text-slate-700 font-medium">
                    Luas Tanah: {{ $property->area }} m²
                </p>
            </div>

            <div>
                <h3 class="text-lg font-bold text-slate-900 mb-3">Deskripsi</h3>
                <div class="prose text-slate-600 text-sm leading-relaxed max-w-none">
                    <p class="mb-4">
                        {{ $property->description ?? 'Deskripsi lengkap belum tersedia untuk properti ini. Namun properti ini menjanjikan investasi yang menarik dengan lokasi yang strategis.' }}
                    </p>
                    
                    <p class="mb-2 font-semibold">Fasilitas:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Sertifikat SHM</li>
                        <li>Akses Jalan Mobil</li>
                        <li>Bebas Banjir</li>
                    </ul>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-4 mt-6">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-full border-2 border-slate-900 p-0.5">
                        <img alt="Seller" class="w-full h-full rounded-full object-cover" src="https://ui-avatars.com/api/?name=Admin+LandHub&background=random"/>
                    </div>
                </div>
                <button class="flex-1 w-full sm:w-auto bg-primary hover:bg-blue-900 text-white font-medium py-3 px-6 rounded-lg flex items-center justify-center gap-2 transition">
                    <span class="material-icons-outlined text-sm">chat_bubble</span>
                    Hubungi Penjual
                </button>
                <button class="flex-1 w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-lg flex items-center justify-center gap-2 transition">
                    <span class="material-icons-outlined text-sm">shopping_cart</span>
                    Lanjut Transaksi
                </button>
            </div>

            <div class="mt-10 border border-slate-200 rounded-lg p-6 bg-white shadow-sm">
                <h3 class="font-bold text-sm text-slate-500 mb-4">Diskusi / Komentar</h3>
                <div class="space-y-6">
                    <div class="flex gap-3">
                        <img alt="User" class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=Udin&background=random"/>
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xs text-slate-900">Udin123</span>
                                <span class="text-[10px] text-slate-400">2 hari lalu</span>
                            </div>
                            <p class="text-sm text-slate-700 mt-1">Surat-surat aman gan?</p>
                        </div>
                    </div>
                </div>
                <div class="mt-6 relative">
                    <input class="w-full text-sm border border-slate-200 rounded-md py-2 px-3 pr-10 focus:ring-1 focus:ring-primary bg-transparent" placeholder="Tanya sesuatu..." type="text"/>
                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-primary">
                        <span class="material-icons-outlined text-sm">send</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 space-y-6">
            <div class="relative w-full h-64 md:h-80 rounded-xl overflow-hidden shadow-md group">
                <img 
                    alt="{{ $property->title }}" 
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                    src="{{ $property->image ? asset(ltrim($property->image, '/')) : 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80' }}"
                />
                <div class="absolute bottom-4 right-4 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded shadow-lg transform rotate-[-5deg]">FOR SALE</div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="aspect-video rounded-lg overflow-hidden shadow-sm">
                    <img class="w-full h-full object-cover hover:opacity-90 transition" src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=400&q=80" alt="Interior"/>
                </div>
                <div class="aspect-video rounded-lg overflow-hidden shadow-sm">
                    <img class="w-full h-full object-cover hover:opacity-90 transition" src="https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=400&q=80" alt="Exterior"/>
                </div>
                <div class="aspect-video rounded-lg overflow-hidden shadow-sm relative group cursor-pointer">
                    <img class="w-full h-full object-cover group-hover:opacity-75 transition" src="https://images.unsplash.com/photo-1600596542815-2250c385e319?auto=format&fit=crop&w=400&q=80" alt="More"/>
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 group-hover:bg-opacity-20">
                        <span class="text-white text-xs font-semibold">+3 Lainnya</span>
                    </div>
                </div>
            </div>

            <div class="w-full h-48 md:h-64 rounded-xl overflow-hidden shadow-md mt-6 relative">
                <iframe 
                    width="100%" 
                    height="100%" 
                    frameborder="0" 
                    scrolling="no" 
                    marginheight="0" 
                    marginwidth="0" 
                    src="https://maps.google.com/maps?q={{ urlencode($property->location) }}&t=&z=13&ie=UTF8&iwloc=&output=embed">
                </iframe>
            </div>
        </div>

    </main>

    <footer class="bg-white border-t border-slate-100 pt-16 pb-8">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12 text-sm">
            <div>
                <h3 class="text-xl font-bold text-primary mb-4">LandHub</h3>
                <p class="text-slate-500 mb-1">Temukan Lahan Impianmu</p>
                <p class="text-slate-500">di LandHub</p>
            </div>
            <div>
                <h4 class="font-bold text-slate-900 mb-4">Hubungi Kami :</h4>
                <ul class="space-y-2 text-slate-500">
                    <li>info@LandHub.com</li>
                    <li>+62 812 3456 7899</li>
                </ul>
            </div>
        </div>
        <div class="mt-16 text-center text-xs text-slate-400">
            <p>© LandHub 2025 - by greatest team 3 <span class="text-red-500">❤️</span></p>
        </div>
    </footer>

    <script>
        function toggleProfilePopup() {
            const popup = document.getElementById('profilePopup');
            popup.classList.toggle('hidden');
        }
    </script>
</body>
</html>