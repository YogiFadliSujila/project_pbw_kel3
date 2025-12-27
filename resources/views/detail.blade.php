<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $property->title }} - LandHub</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#1e3a8a", 
                        secondary: "#2563eb", 
                        "primary-light": "#eff6ff", // Biru sangat muda untuk bubble komentar
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
                    borderRadius: {
                        DEFAULT: "0.5rem",
                    },
                },
            },
        };
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Style untuk Material Symbols */
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        
        /* Menghilangkan marker default pada details/summary */
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
        /* Custom Scrollbar untuk Chat/Komentar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9; /* Slate-100 */
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1; /* Slate-300 */
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #94a3b8; /* Slate-400 */
        }
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
                            <button onclick="toggleProfilePopup()" class="text-black hover:text-gray-500">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>
                        <div class="h-px w-full bg-[#E9D5FF] mb-6"></div>
                        <div class="space-y-3">
                            <a href="{{ route('chat.index') }}" class="flex items-center justify-between w-full p-4 bg-[#EEF2FF] rounded-xl text-[#1E2B58] font-bold hover:bg-blue-100 transition group">
                                <div class="flex items-center gap-3">
                                    <span class="material-icons-outlined text-blue-900">chat_bubble_outline</span>
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
                    {{ $property->description }}
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
                        {{ $property->specifications ?? 'Deskripsi lengkap belum tersedia.' }}
                    </p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-4 mt-6">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 rounded-full border-2 border-slate-900 p-0.5">
                        <img alt="{{ $property->user->name }}" class="w-full h-full rounded-full object-cover" 
                             src="https://ui-avatars.com/api/?name={{ urlencode($property->user->name) }}&background=random"/>
                    </div>
                </div>

                @auth
                    @if(auth()->id() !== $property->user_id)
                        <form action="{{ route('chat.initiate') }}" method="POST" class="flex-1 w-full sm:w-auto">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $property->user_id }}">
                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                            
                            <button type="submit" class="w-full bg-primary hover:bg-blue-900 text-white font-medium py-3 px-6 rounded-lg flex items-center justify-center gap-2 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <span class="material-icons-outlined text-sm">chat_bubble</span>
                                Hubungi Penjual
                            </button>
                        </form>
                    @else
                        <div class="flex-1 w-full sm:w-auto bg-gray-100 text-gray-500 font-medium py-3 px-6 rounded-lg flex items-center justify-center gap-2 border border-gray-200 cursor-default">
                            <span class="material-icons-outlined text-sm">person</span>
                            Ini Properti Anda
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="flex-1 w-full sm:w-auto bg-primary hover:bg-blue-900 text-white font-medium py-3 px-6 rounded-lg flex items-center justify-center gap-2 transition">
                        <span class="material-icons-outlined text-sm">login</span>
                        Login untuk Chat
                    </a>
                @endauth

                <a href="{{ route('payment.show', $property->id) }}" class="flex-1 w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-lg flex items-center justify-center gap-2 transition text-center shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <span class="material-icons-outlined text-sm">shopping_cart</span>
                    Lanjut Transaksi
                </a>
            </div>

            <div class="mt-12 border border-slate-200 rounded-xl p-6 bg-white shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-lg text-slate-800">Diskusi / Komentar ({{ $property->comments->count() }})</h3>
                </div>

                <div class="space-y-8 max-h-[600px] overflow-y-auto pr-4 custom-scrollbar">
                    @forelse($property->comments as $comment)
                        <div class="group">
                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <img alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-sm" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random"/>
                                </div>
                                
                                <div class="flex-1">
                                    <div class="bg-primary-light rounded-2xl rounded-tl-none p-4 relative">
                                        <div class="flex justify-between items-start mb-1">
                                            <div class="flex items-center gap-2">
                                                <span class="font-bold text-sm text-slate-900">{{ $comment->user->name }}</span>
                                                @if($comment->user_id == $property->user_id)
                                                    <span class="bg-primary/10 text-primary text-[10px] px-1.5 py-0.5 rounded font-semibold">Seller</span>
                                                @endif
                                            </div>
                                            <span class="text-xs text-slate-400">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-slate-700 leading-relaxed">{{ $comment->body }}</p>
                                    </div>

                                    <div class="flex items-center gap-4 mt-2 ml-1">
                                        <button onclick="toggleReplyForm({{ $comment->id }})" class="text-xs font-semibold text-primary hover:text-blue-700 transition-colors">Balas</button>
                                        <button class="text-xs font-medium text-slate-500 hover:text-slate-700 transition-colors">Suka</button>
                                    </div>

                                    <div id="reply-form-{{ $comment->id }}" class="hidden mt-3 ml-1 animate-fade-in-down">
                                        @auth
                                            <form action="{{ route('comments.store', $property->id) }}" method="POST" class="flex gap-2">
                                                @csrf
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <input name="body" class="w-full text-xs bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 focus:ring-1 focus:ring-primary focus:border-primary transition" placeholder="Tulis balasan..." required autocomplete="off">
                                                <button type="submit" class="bg-primary text-white text-xs px-4 py-2 rounded-lg hover:bg-blue-800 transition shadow-sm">Kirim</button>
                                            </form>
                                        @endauth
                                    </div>

                                    @if($comment->replies->count() > 0)
                                        <details class="group/replies ml-2 mt-2">
                                            <summary class="flex items-center cursor-pointer text-xs font-medium text-slate-500 hover:text-primary select-none py-1">
                                                <span class="mr-1 group-open/replies:hidden">Lihat {{ $comment->replies->count() }} balasan</span>
                                                <span class="mr-1 hidden group-open/replies:inline">Sembunyikan balasan</span>
                                                <span class="material-symbols-outlined text-[16px] transition-transform group-open/replies:rotate-180">expand_more</span>
                                            </summary>
                                            
                                            <div class="mt-3 pl-4 border-l-2 border-slate-100 space-y-4">
                                                @foreach($comment->replies as $reply)
                                                    <div class="flex gap-3">
                                                        <div class="flex-shrink-0">
                                                            <img alt="{{ $reply->user->name }}" class="w-8 h-8 rounded-full border border-slate-200 object-cover" 
                                                                 src="https://ui-avatars.com/api/?name={{ urlencode($reply->user->name) }}&background=random"/>
                                                        </div>
                                                        <div class="flex-1">
                                                            <div class="bg-slate-50 rounded-2xl rounded-tl-none p-3 border border-slate-100">
                                                                <div class="flex justify-between items-start mb-1">
                                                                    <div class="flex items-center gap-2">
                                                                        <span class="font-bold text-sm text-slate-900">{{ $reply->user->name }}</span>
                                                                        @if($reply->user_id == $property->user_id)
                                                                            <span class="bg-primary/10 text-primary text-[10px] px-1.5 py-0.5 rounded font-semibold">Seller</span>
                                                                        @endif
                                                                    </div>
                                                                    <span class="text-xs text-slate-400">{{ $reply->created_at->diffForHumans() }}</span>
                                                                </div>
                                                                <p class="text-sm text-slate-700 leading-relaxed">{{ $reply->body }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </details>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="material-icons-outlined text-slate-400 text-2xl">chat_bubble_outline</span>
                            </div>
                            <p class="text-sm text-slate-500 font-medium">Belum ada diskusi.</p>
                            <p class="text-xs text-slate-400">Jadilah yang pertama bertanya tentang lahan ini!</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100">
                    @auth
                        <form action="{{ route('comments.store', $property->id) }}" method="POST" class="flex items-start gap-4">
                            <div class="flex-shrink-0 hidden sm:block">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" 
                                     class="w-10 h-10 rounded-full border border-slate-200 shadow-sm">
                            </div>
                            <div class="flex-1 relative">
                                @csrf
                                <input name="body" class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl py-3 px-4 pr-14 focus:ring-2 focus:ring-primary focus:border-primary transition outline-none shadow-sm" 
                                       placeholder="Tulis pertanyaan atau komentar..." type="text" required autocomplete="off"/>
                                
                                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-primary hover:text-blue-800 p-2 transition">
                                    <span class="material-icons-outlined text-xl">send</span>
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-4 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                            <p class="text-sm text-slate-500">
                                Silakan <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Login</a> untuk ikut berdiskusi.
                            </p>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 space-y-6">
            
            <div class="relative w-full h-64 md:h-80 rounded-xl overflow-hidden shadow-md group">
                <img 
                    alt="{{ $property->title }}" 
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" 
                    src="{{ $property->image ? asset($property->image) : 'https://via.placeholder.com/800' }}"
                />
                <div class="absolute bottom-4 right-4 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded shadow-lg transform rotate-[-5deg]">FOR SALE</div>
            </div>

            @php
                $gallery = $property->gallery ?? collect([]);
            @endphp

            @if($gallery->count() > 0)
            <div class="grid grid-cols-3 gap-4"> 
                @foreach($gallery->take(9) as $index => $img)
                    <div class="aspect-video rounded-lg overflow-hidden shadow-sm relative group cursor-pointer">
                        <img 
                            class="w-full h-full object-cover hover:opacity-90 transition" 
                            src="{{ asset('storage/' . $img->image_path) }}" 
                            alt="Gallery {{ $index }}"
                        />
                        @if($loop->last && $gallery->count() > 9)
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 group-hover:bg-opacity-40 transition">
                                <span class="text-white font-bold text-lg">
                                    +{{ $gallery->count() - 9 }} Lainnya
                                </span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            @endif

            <div class="w-full h-48 md:h-64 rounded-xl overflow-hidden shadow-md mt-6 relative">
                <iframe 
                    width="100%" 
                    height="100%" 
                    frameborder="0" 
                    scrolling="no" 
                    marginheight="0" 
                    marginwidth="0" 
                    src="https://maps.google.com/maps?q={{ $property->latitude && $property->longitude ? $property->latitude . ',' . $property->longitude : urlencode($property->location) }}&z=15&output=embed">
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
        function toggleReplyForm(commentId) {
            const form = document.getElementById(`reply-form-${commentId}`);
            form.classList.toggle('hidden');
        }
    </script>
</body>
</html>