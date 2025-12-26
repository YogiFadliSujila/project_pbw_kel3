<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Profil Pengguna</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#1e3a8a", 
                        "background-light": "#F8FAFC", 
                        "background-dark": "#0f172a", 
                        "accent-purple": "#E0D4FC", 
                        "accent-bg": "#EBEFFC", 
                    },
                    fontFamily: {
                        display: ["Poppins", "sans-serif"],
                    },
                },
            },
        };
    </script>
</head>
<body class="bg-background-light text-slate-800 font-display antialiased transition-colors duration-200">

<header class="w-full bg-white py-4 px-6 md:px-12 flex items-center justify-between shadow-sm">
    <div class="flex items-center">
        <a href="{{ route('landing') }}" class="text-2xl font-bold text-primary tracking-tight">LandHub</a>
    </div>
    <div class="flex items-center gap-6 md:gap-8">
        <nav class="hidden md:flex gap-8 text-sm font-medium">
            <a class="text-slate-900 hover:text-primary transition-colors" href="{{ route('landing') }}">Home</a>
            <a class="text-slate-900 hover:text-primary transition-colors" href="#">About Us</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-10 h-10 rounded-full bg-accent-purple/50 flex items-center justify-center text-primary hover:bg-red-100 hover:text-red-600 transition-all" title="Logout">
                <span class="material-icons text-xl">logout</span>
            </button>
        </form>
    </div>
</header>

<div class="w-full bg-indigo-50 py-3 px-6 md:px-12 border-b border-indigo-100">
    <a class="text-xs font-medium text-slate-600 flex items-center gap-1 hover:text-primary transition-colors" href="{{ route('landing') }}">
        <span class="material-icons text-sm">chevron_left</span> Beranda
    </a>
</div>

<main class="w-full max-w-7xl mx-auto px-4 py-10 md:py-14">
    
    <div class="flex flex-col items-center mb-12">
        <div class="w-32 h-32 rounded-full bg-accent-purple flex items-center justify-center mb-4 ring-4 ring-white shadow-lg overflow-hidden">
            <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=E0D4FC&color=1e3a8a&size=128" alt="{{ $user->name }}" class="w-full h-full object-cover">
        </div>
        <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-1 text-center">{{ $user->name }}</h2>
        
        @if(count($myProperties) > 0 || $user->role == 'penjual')
            <span class="px-4 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-bold mt-2 border border-blue-200">
                Penjual Lahan
            </span>
        @else
            <span class="px-4 py-1 rounded-full bg-green-100 text-green-700 text-sm font-bold mt-2 border border-green-200">
                Pencari Lahan
            </span>
        @endif
    </div>

    <div class="bg-accent-bg rounded-[2rem] p-6 md:p-10 space-y-12 shadow-sm min-h-[400px]">

        {{-- KONDISI 1: TAMPILAN UNTUK PENJUAL (Daftar Properti Saya) --}}
        @if(count($myProperties) > 0 || $user->role == 'penjual')
            
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-slate-800">Properti Saya</h3>
                <a href="#" class="text-sm font-medium text-primary hover:underline">+ Tambah Properti</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($myProperties as $prop)
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-md transition group relative">
                    
                    <div class="relative h-64 w-full overflow-hidden">
                        <img 
                            src="{{ $prop->image ? asset(ltrim($prop->image, '/')) : 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80' }}" 
                            alt="{{ $prop->title }}" 
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        >
                        
                        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition duration-300"></div>

                        <div class="absolute inset-0 flex items-center justify-center">
                            @php
                                // Tentukan warna border dan text berdasarkan status
                                $statusClass = match($prop->status) {
                                    'Rejected'  => 'border-red-500 text-red-500',
                                    'Sold'      => 'border-blue-500 text-blue-500',
                                    'Pending'   => 'border-orange-400 text-orange-400',
                                    'Accepted' => 'border-green-400 text-green-400',
                                    default     => 'border-white text-white'
                                };
                            @endphp
                            
                            <div class="border-4 {{ $statusClass }} px-6 py-2 rounded-lg transform -rotate-12 opacity-90 backdrop-blur-sm bg-black/30">
                                <span class="text-2xl font-black uppercase tracking-widest {{ $statusClass }}">
                                    {{ $prop->status }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5">
                        <h4 class="font-bold text-slate-900 text-lg mb-1 truncate">{{ $prop->title }}</h4>
                        <p class="text-slate-500 text-sm mb-3 truncate">{{ $prop->location }}</p>
                        <div class="flex justify-between items-center pt-3 border-t border-slate-100">
                            <span class="font-bold text-primary">Rp {{ number_format($prop->price, 0, ',', '.') }}</span>
                            <span class="text-xs text-slate-400">{{ $prop->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>

            @if(count($myProperties) == 0)
                <div class="text-center py-10">
                    <p class="text-slate-500">Anda belum mengupload properti apapun.</p>
                </div>
            @endif


        {{-- KONDISI 2: TAMPILAN UNTUK PENCARI (Riwayat Pembelian) --}}
        @else
            
            <h3 class="text-xl font-bold text-slate-800 mb-6">Riwayat Pembelian</h3>

            @forelse($transactions as $trx)
            <div class="flex flex-col lg:flex-row gap-8 items-start bg-white p-6 rounded-3xl shadow-sm border border-slate-100 mb-8">
                <div class="w-full lg:w-[350px] h-64 flex-shrink-0 overflow-hidden rounded-2xl relative group">
                    <img 
                        alt="{{ $trx->property->title }}" 
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                        src="{{ asset(ltrim($trx->property->image)) }}"
                    />
                    <div class="absolute top-4 left-4 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                        LUNAS
                    </div>
                </div>

                <div class="flex-grow w-full">
                    <h3 class="text-xl md:text-2xl font-bold text-slate-900 mb-2">{{ $trx->property->title }}</h3>
                    <p class="text-slate-500 mb-6 text-sm md:text-base leading-relaxed">{{ $trx->property->location }}</p>

                    <div class="bg-slate-50 rounded-xl p-6 border border-slate-100">
                        <div class="space-y-4">
                            <div class="flex flex-wrap gap-2 text-sm md:text-base">
                                <span class="text-slate-500">Dibeli pada Tanggal :</span>
                                <span class="text-red-600 font-bold">{{ $trx->created_at->format('d F Y') }}</span>
                            </div>
                            <div class="flex flex-wrap gap-2 text-sm md:text-base items-center">
                                <span class="text-slate-500">Harga Awal :</span>
                                <span class="text-slate-400 line-through">Rp {{ number_format($trx->property->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex flex-wrap gap-2 text-sm md:text-base items-center">
                                <span class="text-slate-500">Dibeli dengan Harga :</span>
                                <span class="text-red-600 font-bold text-lg">Rp {{ number_format($trx->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="flex flex-col items-center justify-center py-10 text-center">
                <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                    <span class="material-icons text-4xl text-gray-400">shopping_bag</span>
                </div>
                <h3 class="text-xl font-bold text-slate-700">Belum ada properti yang dibeli</h3>
                <a href="{{ route('listing.index') }}" class="mt-4 px-6 py-3 bg-primary text-white rounded-lg hover:bg-blue-800 transition">Cari Properti</a>
            </div>
            @endforelse

        @endif

    </div>
</main>

<footer class="w-full bg-white border-t border-slate-100 py-12 px-6 md:px-12 text-center text-xs text-slate-500">
    © LandHub 2025 - by greatest team 3 <span class="text-red-500">❤</span>
</footer>

</body>
</html>