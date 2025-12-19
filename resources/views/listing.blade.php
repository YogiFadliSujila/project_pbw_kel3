<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temukan Lahan - LandHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            
            @auth
                <a href="{{ url('/dashboard') }}" class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-800 font-bold hover:bg-blue-200 transition">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </a>
            @else
                <a href="{{ route('login') }}" class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 hover:bg-purple-200 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </a>
            @endauth
        </div>
    </nav>

    <section class="px-6 md:px-12 max-w-4xl mx-auto mt-6 mb-12">
        <div class="relative">
            <input type="text" placeholder="Cari Lahan impianmu..." class="w-full py-4 pl-8 pr-16 rounded-lg bg-[#EAF0F6] border-none focus:ring-2 focus:ring-blue-300 shadow-sm text-gray-700 placeholder-gray-500">
            <button class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            </button>
        </div>
    </section>

    <div class="text-center mb-12">
        <h1 class="text-2xl md:text-3xl font-bold text-[#1E2B58] mb-2">Temukan Lahan Impianmu</h1>
        <p class="text-xs md:text-sm text-gray-500">Tempat yang strategis dengan harga minimalis</p>
    </div>

    <section class="px-6 md:px-12 max-w-7xl mx-auto mb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-10">
            
            @foreach($properties as $prop)
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition group">
                <div class="rounded-xl overflow-hidden mb-4 relative h-64 w-full">
                    <img 
                        src="{{asset(ltrim($prop->image, '/'))}}" 
                        alt="{{ $prop->title }}" 
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500"
                    >
                </div>
                
                <div class="flex justify-between items-end mb-1">
                    <h4 class="text-xl font-bold text-[#1E2B58]">
                        Rp {{ number_format($prop->price, 0, ',', '.') }}
                    </h4>
                    <p class="text-xs font-bold text-gray-800">Luas Tanah: {{ $prop->area ?? '-' }} m²</p>
                </div>
                
                <h5 class="font-bold text-black text-sm mb-2">{{ $prop->title }}</h5>
                
                <p class="text-[10px] text-gray-500 mb-4 leading-relaxed line-clamp-2">
                    {{ $prop->location ?? 'Lokasi tidak tersedia' }}
                </p>
                
                <a href="#" class="text-xs font-bold text-blue-700 hover:underline">Detail Lahan</a>
            </div>
            @endforeach

        </div>
    </section>

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