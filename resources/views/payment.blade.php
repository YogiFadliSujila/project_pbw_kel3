<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - {{ $property->title }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Poppins:wght@500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet"/>
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#1B2C56", // Dark Navy sesuai desain
                        "primary-hover": "#2A4075",
                        "background-light": "#F8FAFC",
                        "input-light": "#F1F1F1",
                        "card-light": "#F4F5F7",
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"],
                        display: ["Poppins", "sans-serif"],
                    },
                },
            },
        };
    </script>
</head>
<body class="bg-background-light text-slate-800 font-sans antialiased">

    <nav class="w-full bg-white px-6 py-4 flex justify-between items-center shadow-sm relative z-50">
        <div class="flex items-center">
            <h1 class="text-2xl font-bold font-display text-primary">LandHub</h1>
        </div>
        <div class="flex items-center gap-8">
            <a class="text-slate-600 font-medium hover:text-primary transition" href="{{ route('landing') }}">Home</a>
            <a class="text-slate-600 font-medium hover:text-primary transition" href="#">About Us</a>
            
            @auth
                <div class="relative">
                    <button onclick="toggleProfilePopup()" class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold border-2 border-transparent hover:border-indigo-300 transition focus:outline-none">
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

                            <a href="{{route('profil')}}" class="flex items-center justify-between w-full p-4 bg-[#EEF2FF] rounded-xl text-[#1E2B58] font-bold hover:bg-blue-100 transition group">
                                <span>Profil</span>
                                <svg class="w-5 h-5 text-black group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
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

    <div class="w-full bg-indigo-50 py-3 px-6 md:px-12 lg:px-24">
        <a class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-primary transition" href="{{ url()->previous() }}">
            <span class="material-icons text-base mr-1">chevron_left</span>
            Kembali
        </a>
    </div>

    <main class="max-w-7xl mx-auto px-6 md:px-12 lg:px-24 py-12 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24">
        
        <div class="lg:col-span-7 flex flex-col gap-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold font-display text-slate-900 mb-4 leading-tight">
                    {{ $property->title }}
                </h2>
                <div class="space-y-1 text-slate-600 text-sm">
                    <p>{{ $property->location ?? 'Lokasi tidak tersedia' }}</p>
                    <p class="font-medium text-slate-800">Luas Tanah: {{ $property->area }} m²</p>
                </div>
            </div>

            <form action="{{ route('payment.process') }}" method="POST" class="flex flex-col gap-5 mt-4">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">

                <div>
                    <input 
                        name="card_holder_name" 
                        id="cardHolderName" 
                        class="w-full bg-input-light border-none rounded-lg px-5 py-4 text-slate-700 placeholder-slate-500 focus:ring-2 focus:ring-primary focus:outline-none transition-shadow" 
                        placeholder="Nama Pemegang Kartu" 
                        type="text" 
                        value="{{ Auth::user()->name }}"
                        required
                    />
                </div>

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <div class="flex -space-x-3">
                            <div class="w-6 h-6 rounded-full bg-red-500 opacity-80"></div>
                            <div class="w-6 h-6 rounded-full bg-yellow-500 opacity-80"></div>
                        </div>
                    </div>
                    <input 
                        name="card_number"
                        class="w-full bg-input-light border-none rounded-lg pl-14 pr-5 py-4 text-slate-700 placeholder-slate-500 focus:ring-2 focus:ring-primary focus:outline-none transition-shadow" 
                        placeholder="Nomor Kartu" 
                        type="text"
                    />
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <input
                        name="expiry_date"
                        id="cardExpiry"
                        class="w-full bg-input-light border-none rounded-lg px-5 py-4 text-slate-700 placeholder-slate-500 focus:ring-2 focus:ring-primary focus:outline-none transition-shadow"
                        placeholder="Tanggal (DD/MM/YYYY)"
                        type="text"
                    />
                    <input 
                        name="cvv"
                        class="w-full bg-input-light border-none rounded-lg px-5 py-4 text-slate-700 placeholder-slate-500 focus:ring-2 focus:ring-primary focus:outline-none transition-shadow" 
                        placeholder="Kode CVV" 
                        type="text"
                    />
                </div>

                <div class="relative">
                    <input 
                        name="promo_code"
                        class="w-full bg-input-light border-none rounded-lg pl-5 pr-20 py-4 text-slate-700 placeholder-slate-500 focus:ring-2 focus:ring-primary focus:outline-none transition-shadow" 
                        placeholder="Kode Promo" 
                        type="text"
                    />
                    <button class="absolute inset-y-0 right-0 pr-5 flex items-center font-bold text-primary hover:text-primary-hover transition" type="button">
                        Apply
                    </button>
                </div>
                
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <strong class="font-bold">Ada kesalahan!</strong>
                        <ul class="mt-1 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mt-4">
                    <button type="submit" class="bg-primary hover:bg-primary-hover text-white font-bold py-4 px-10 rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 w-full md:w-auto min-w-[160px]">
                        Bayar Sekarang
                    </button>
                </div>
            </form>
        </div>

        <div class="lg:col-span-5">
            <div class="bg-card-light rounded-2xl p-8 md:p-10 sticky top-10">
                <div class="text-center mb-10">
                    <h3 class="text-3xl md:text-4xl font-bold font-display text-slate-900">
                        Rp {{ number_format($property->price, 0, ',', '.') }}
                    </h3>
                </div>
                <div class="space-y-6">
                    <div class="flex justify-between items-center text-slate-700 font-semibold text-lg">
                        <span>Harga Properti</span>
                        <span class="font-bold text-slate-900">
                            Rp {{ number_format($property->price, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center text-slate-700 font-semibold text-lg">
                        <span>Diskon</span>
                        <span class="font-bold text-slate-900">Rp 0</span>
                    </div>
                    
                    <div class="h-px bg-slate-300 my-6"></div>
                    
                    <div class="flex justify-between items-center text-slate-700 font-semibold text-lg">
                        <span>Pajak (Tax)</span>
                        <span class="font-bold text-slate-900">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center text-slate-900 text-xl md:text-2xl font-bold pt-2">
                        <span>Total</span>
                        <span>Rp {{ number_format($property->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="paymentOverlay" class="hidden fixed inset-0 z-[100] flex items-center justify-center transition-opacity duration-300 opacity-0">
        
        <div class="absolute inset-0 bg-slate-900 bg-opacity-60 backdrop-blur-sm"></div>

        <div id="paymentCard" class="bg-white rounded-3xl shadow-2xl w-full max-w-md mx-4 relative p-8 transform transition-all duration-300 scale-95 opacity-0">
            
            <button onclick="closePaymentModal()" class="absolute top-6 right-6 text-slate-400 hover:text-slate-800 transition hover:rotate-90 duration-200">
                <span class="material-icons-outlined text-3xl">close</span>
            </button>

            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center shadow-lg shadow-indigo-200 animate-bounce">
                    <span class="material-icons text-white text-5xl">check</span>
                </div>
            </div>

            <div class="text-center mb-8">
                <h3 class="text-xl text-slate-600 font-medium mb-2">Payment Success!</h3>
                <h2 class="text-3xl font-bold text-slate-900 font-display">
                    Rp {{ number_format($property->price, 0, ',', '.') }},00
                </h2>
            </div>

            <div class="border-t border-dashed border-slate-300 my-6"></div>

            <div class="space-y-4 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Ref Number</span>
                    <span class="font-semibold text-slate-800" id="receiptRef">000085752257</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Payment Time</span>
                    <span class="font-semibold text-slate-800" id="receiptTime">...</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Payment Method</span>
                    <span class="font-semibold text-slate-800">Bank Transfer</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Sender Name</span>
                    <span class="font-semibold text-slate-800" id="receiptSender">{{ Auth::user()->name }}</span>
                </div>

            </div>

            <div class="border-t border-dashed border-slate-300 my-6"></div>

            <div class="space-y-4 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Amount</span>
                    <span class="font-semibold text-slate-800">Rp {{ number_format($property->price, 0, ',', '.') }},00</span>
                </div>
                 <div class="flex justify-between items-center">
                    <span class="text-slate-500">Admin Fee</span>
                    <span class="font-semibold text-slate-800">Rp 0</span>
                </div>
            </div>

            <div class="border-t border-dashed border-slate-300 my-6"></div>

            <div class="text-center">
                <p class="text-xs text-slate-400">Terima kasih telah mempercayai LandHub</p>
            </div>

        </div>
    </div>

    <footer class="mt-12 py-6 text-center text-slate-400 text-sm">
        © 2025 LandHub Inc. All rights reserved.
    </footer>

    <script>
        // Cek apakah server mengirim sinyal sukses
        // Cek apakah server mengirim sinyal sukses beserta DATA ASLI
        @if(session('success_transaction'))
            document.addEventListener("DOMContentLoaded", function() {
                // 1. Masukkan Data Asli dari Database ke Element HTML
                document.getElementById('receiptRef').innerText = "{{ session('real_trx_code') }}";
                document.getElementById('receiptTime').innerText = "{{ session('real_trx_time') }}";
                
                // 2. Munculkan Modal
                showPaymentSuccess(); 
            });
        @endif

        function showPaymentSuccess() {
            const overlay = document.getElementById('paymentOverlay');
            const card = document.getElementById('paymentCard');
            
            // CATATAN:
            // Kita HAPUS bagian generate randomRef dan new Date() di sini
            // Karena datanya sudah kita isi via PHP Session di atas.

            // Ambil nama pengirim dari input (jika ada), atau default user
            const inputName = document.getElementById('cardHolderName');
            if(inputName && inputName.value) {
                document.getElementById('receiptSender').innerText = inputName.value;
            }

            // Animasi Masuk
            overlay.classList.remove('hidden');
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closePaymentModal() {
            const overlay = document.getElementById('paymentOverlay');
            const card = document.getElementById('paymentCard');

            // 1. ANIMASI KELUAR (Close)
            // Kembalikan ke state transparan dan kecil
            overlay.classList.add('opacity-0');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');

            // 2. Tunggu durasi animasi selesai (300ms) baru sembunyikan (hidden)
            setTimeout(() => {
                // ARAHKAN KE ROUTE PROFILE
                window.location.href = "{{ route('profil') }}";
            }, 300);
        }

        // Script Pop Up Profil
        function toggleProfilePopup() {
            const popup = document.getElementById('profilePopup');
            if (popup.classList.contains('hidden')) {
                popup.classList.remove('hidden');
                setTimeout(() => {
                    popup.classList.remove('opacity-0', '-translate-y-2');
                    popup.classList.add('opacity-100', 'translate-y-0');
                }, 10);
            } else {
                popup.classList.remove('opacity-100', 'translate-y-0');
                popup.classList.add('opacity-0', '-translate-y-2');
                setTimeout(() => {
                    popup.classList.add('hidden');
                }, 200);
            }
        }

        // Auto-fill expiry date input with current month/year (MM/YY)
        document.addEventListener('DOMContentLoaded', function () {
            const expiryInput = document.getElementById('cardExpiry');
            if (!expiryInput) return;

            const now = new Date();
            const dd = String(now.getDate()).padStart(2, '0');
            const mm = String(now.getMonth() + 1).padStart(2, '0');
            const yyyy = now.getFullYear();

            expiryInput.value = `${dd}/${mm}/${yyyy}`;
        });

    </script>
</body>
</html>