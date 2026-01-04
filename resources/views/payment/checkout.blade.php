<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - {{ $property->title ?? 'Checkout' }}</title>
    
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
                        primary: "#1B2C56",
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
            @auth
                <div class="font-bold text-primary">{{ Auth::user()->name }}</div>
            @endauth
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
                    {{ $property->title ?? $property->description }}
                </h2>
                <div class="space-y-1 text-slate-600 text-sm">
                    <p>{{ $property->location ?? 'Lokasi tidak tersedia' }}</p>
                    <p class="font-medium text-slate-800">Luas Tanah: {{ $property->area }} m²</p>
                    <span class="inline-block mt-2 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">
                        {{ $property->category }}
                    </span>
                </div>
            </div>

            <form action="{{ route('payment.process') }}" method="POST" class="flex flex-col gap-5 mt-4">
                @csrf
                <input type="hidden" name="property_id" value="{{ $property->id }}">
                
                @if(isset($dealId) && $dealId)
                    <input type="hidden" name="deal_id" value="{{ $dealId }}">
                    <input type="hidden" name="amount" value="{{ $priceToPay }}"> <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2">
                        <span class="material-icons text-sm">verified</span>
                        <span class="text-sm font-bold">Harga Deal Spesial diterapkan!</span>
                    </div>
                @else
                    <input type="hidden" name="amount" value="{{ $priceToPay }}"> @endif

                <div>
                    <input name="card_holder_name" value="{{ Auth::user()->name }}" class="w-full bg-input-light border-none rounded-lg px-5 py-4 text-slate-700 placeholder-slate-500 focus:ring-2 focus:ring-primary focus:outline-none transition-shadow" placeholder="Nama Pemegang Kartu" type="text" required />
                </div>

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <div class="flex -space-x-3">
                            <div class="w-6 h-6 rounded-full bg-red-500 opacity-80"></div>
                            <div class="w-6 h-6 rounded-full bg-yellow-500 opacity-80"></div>
                        </div>
                    </div>
                    <input name="card_number" class="w-full bg-input-light border-none rounded-lg pl-14 pr-5 py-4 text-slate-700 placeholder-slate-500 focus:ring-2 focus:ring-primary focus:outline-none transition-shadow" placeholder="Nomor Kartu" type="text" />
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <input name="expiry_date" id="cardExpiry" class="w-full bg-input-light border-none rounded-lg px-5 py-4 text-slate-700 placeholder-slate-500 focus:ring-2 focus:ring-primary focus:outline-none transition-shadow" placeholder="MM/YY" type="text" />
                    <input name="cvv" class="w-full bg-input-light border-none rounded-lg px-5 py-4 text-slate-700 placeholder-slate-500 focus:ring-2 focus:ring-primary focus:outline-none transition-shadow" placeholder="CVV" type="text" />
                </div>

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
                        Rp {{ number_format($priceToPay, 0, ',', '.') }}
                    </h3>
                    @if($priceToPay < $property->price)
                        <span class="text-sm text-gray-400 line-through">Rp {{ number_format($property->price, 0, ',', '.') }}</span>
                    @endif
                </div>
                <div class="space-y-6">
                    <div class="flex justify-between items-center text-slate-700 font-semibold text-lg">
                        <span>Harga Asli</span>
                        <span class="font-bold text-slate-900">
                            Rp {{ number_format($property->price, 0, ',', '.') }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center text-slate-700 font-semibold text-lg">
                        <span>Diskon / Deal</span>
                        <span class="font-bold text-green-600">
                            - Rp {{ number_format($property->price - $priceToPay, 0, ',', '.') }}
                        </span>
                    </div>
                    
                    <div class="h-px bg-slate-300 my-6"></div>
                    
                    <div class="flex justify-between items-center text-slate-900 text-xl md:text-2xl font-bold pt-2">
                        <span>Total Bayar</span>
                        <span class="text-primary">Rp {{ number_format($priceToPay, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Payment Success Overlay -->
    <div id="paymentOverlay" class="hidden fixed inset-0 z-[100] flex items-center justify-center transition-opacity duration-300 opacity-0">
        
        <div class="absolute inset-0 bg-slate-900 bg-opacity-60 backdrop-blur-sm"></div>

        <div id="paymentCard" class="bg-white rounded-3xl shadow-2xl w-full max-w-md mx-4 relative p-8 transform transition-all duration-300 scale-95 opacity-0">
            
            <!-- Close Button -->
            <button onclick="closePaymentModal()" class="absolute top-6 right-6 text-slate-400 hover:text-slate-800 transition hover:rotate-90 duration-200">
                <span class="material-icons-outlined text-3xl">close</span>
            </button>

            <!-- Success Icon -->
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center shadow-lg shadow-indigo-200 animate-bounce">
                    <span class="material-icons text-white text-5xl">check</span>
                </div>
            </div>

            <!-- Success Message & Amount -->
            <div class="text-center mb-8">
                <h3 class="text-xl text-slate-600 font-medium mb-2">Payment Success!</h3>
                <h2 class="text-3xl font-bold text-slate-900 font-display">
                    Rp {{ number_format($priceToPay, 0, ',', '.') }},00
                </h2>
            </div>

            <div class="border-t border-dashed border-slate-300 my-6"></div>

            <!-- Transaction Details -->
            <div class="space-y-4 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Ref Number</span>
                    <span class="font-semibold text-slate-800" id="receiptRef">-</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Payment Time</span>
                    <span class="font-semibold text-slate-800" id="receiptTime">-</span>
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

            <!-- Amount Summary -->
            <div class="space-y-4 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Amount</span>
                    <span class="font-semibold text-slate-800">Rp {{ number_format($priceToPay, 0, ',', '.') }},00</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Admin Fee</span>
                    <span class="font-semibold text-slate-800">Rp 0</span>
                </div>
            </div>

            <div class="border-t border-dashed border-slate-300 my-6"></div>

            <!-- Footer Message -->
            <div class="text-center mb-6">
                <p class="text-xs text-slate-400">Terima kasih telah mempercayai LandHub</p>
            </div>

            <!-- Close Button -->
            <div class="text-center">
                <button onclick="closePaymentModal()" class="bg-primary text-white px-8 py-3 rounded-xl font-bold hover:bg-primary-hover transition transform hover:-translate-y-0.5 shadow-lg">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        // Cek apakah server mengirim sinyal sukses beserta DATA ASLI dari database
        @if(session('success_transaction'))
            document.addEventListener("DOMContentLoaded", function() {
                // 1. Masukkan Data Asli dari Session ke Element HTML
                document.getElementById('receiptRef').innerText = "{{ session('real_trx_code') ?? 'TRX-' + Date.now() }}";
                document.getElementById('receiptTime').innerText = "{{ session('real_trx_time') ?? now()->format('d M Y, H:i') }}";
                
                // 2. Munculkan Modal
                showPaymentSuccess(); 
            });
        @endif

        function showPaymentSuccess() {
            const overlay = document.getElementById('paymentOverlay');
            const card = document.getElementById('paymentCard');

            // Ambil nama pengirim dari input (jika ada)
            const inputName = document.querySelector('input[name="card_holder_name"]');
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

            // 1. Animasi Keluar
            overlay.classList.add('opacity-0');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');

            // 2. Tunggu durasi animasi selesai (300ms) lalu redirect ke profil
            setTimeout(() => {
                window.location.href = "{{ route('profil') }}";
            }, 300);
        }

        // Auto-fill expiry date dengan format DD/MM/YYYY
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