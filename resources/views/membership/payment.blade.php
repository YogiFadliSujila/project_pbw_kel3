<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Paket - LandHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet"/>
    <script>
        tailwind.config = { darkMode: "class", theme: { extend: { colors: { primary: "#1B2C56", "primary-hover": "#2A4075", "background-light": "#F8FAFC", "input-light": "#F1F1F1", "card-light": "#F4F5F7" }, fontFamily: { sans: ["Inter", "sans-serif"], display: ["Poppins", "sans-serif"] } } } };
    </script>
</head>
<body class="bg-background-light text-slate-800 font-sans antialiased">

    <nav class="w-full bg-white px-6 py-4 flex justify-between items-center shadow-sm relative z-50">
        <h1 class="text-2xl font-bold font-display text-primary">LandHub</h1>
        <div class="flex items-center gap-4">
             <div class="font-bold">{{ Auth::user()->name }}</div>
        </div>
    </nav>

    <div class="w-full bg-indigo-50 py-3 px-6 md:px-12 lg:px-24">
        <a class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-primary transition" href="{{ route('pricing.index') }}">
            <span class="material-icons text-base mr-1">chevron_left</span> Kembali ke Pilihan Paket
        </a>
    </div>

    <main class="max-w-7xl mx-auto px-6 md:px-12 lg:px-24 py-12 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24">
        
        <div class="lg:col-span-7 flex flex-col gap-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold font-display text-slate-900 mb-2 leading-tight">
                    Upgrade ke {{ $data['name'] }}
                </h2>
                <p class="text-slate-600">Nikmati fitur premium selama {{ $data['duration'] }}.</p>
            </div>

            <form action="{{ route('membership.process') }}" method="POST" class="flex flex-col gap-5 mt-4">
                @csrf
                <input type="hidden" name="package" value="{{ $package }}">

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Nama Pemegang Kartu</label>
                    <input name="card_holder_name" class="w-full bg-input-light border-none rounded-lg px-5 py-4 text-slate-700" type="text" value="{{ Auth::user()->name }}" required/>
                </div>
                
                <div class="relative">
                    <label class="block text-sm font-bold text-gray-700 mb-1">Nomor Kartu</label>
                    <div class="absolute inset-y-0 top-6 left-0 pl-4 flex items-center pointer-events-none">
                        <div class="flex -space-x-3">
                            <div class="w-6 h-6 rounded-full bg-red-500 opacity-80"></div>
                            <div class="w-6 h-6 rounded-full bg-yellow-500 opacity-80"></div>
                        </div>
                    </div>
                    <input class="w-full bg-input-light border-none rounded-lg pl-14 pr-5 py-4 text-slate-700" placeholder="0000 0000 0000 0000" type="text" required/>
                </div>

                <div class="grid grid-cols-2 gap-5">
                    <div>
                         <label class="block text-sm font-bold text-gray-700 mb-1">Valid Thru</label>
                         <input id="cardExpiry" class="w-full bg-input-light border-none rounded-lg px-5 py-4 text-slate-700" placeholder="MM/YY" type="text" required/>
                    </div>
                    <div>
                         <label class="block text-sm font-bold text-gray-700 mb-1">CVV</label>
                         <input class="w-full bg-input-light border-none rounded-lg px-5 py-4 text-slate-700" placeholder="123" type="text" required/>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-primary hover:bg-primary-hover text-white font-bold py-4 px-10 rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 w-full">
                        Bayar Rp {{ number_format($data['price'], 0, ',', '.') }}
                    </button>
                </div>
            </form>
        </div>

        <div class="lg:col-span-5">
            <div class="bg-card-light rounded-2xl p-8 md:p-10 sticky top-10">
                <div class="flex justify-center mb-6">
                    <div class="w-24 h-24 rounded-full {{ $data['color'] }} flex items-center justify-center text-white shadow-xl">
                        <span class="material-icons text-5xl">stars</span>
                    </div>
                </div>

                <div class="text-center mb-10">
                    <h3 class="text-3xl font-bold font-display text-slate-900">
                        Rp {{ number_format($data['price'], 0, ',', '.') }}
                    </h3>
                    <p class="text-sm text-slate-500">Tagihan per {{ $data['duration'] }}</p>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between items-center text-slate-700 font-semibold text-lg">
                        <span>Paket</span>
                        <span class="font-bold text-slate-900">{{ $data['name'] }}</span>
                    </div>
                    <div class="flex justify-between items-center text-slate-700 text-sm">
                        <span>Benefit Utama</span>
                        <span class="text-right max-w-[150px]">{{ $data['benefits'] }}</span>
                    </div>
                    
                    <div class="h-px bg-slate-300 my-6"></div>
                    
                    <div class="flex justify-between items-center text-slate-900 text-xl font-bold pt-2">
                        <span>Total Bayar</span>
                        <span>Rp {{ number_format($data['price'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="paymentOverlay" class="hidden fixed inset-0 z-[100] flex items-center justify-center transition-opacity duration-300 opacity-0">
        <div class="absolute inset-0 bg-slate-900 bg-opacity-60 backdrop-blur-sm"></div>
        <div id="paymentCard" class="bg-white rounded-3xl shadow-2xl w-full max-w-md mx-4 relative p-8 transform transition-all duration-300 scale-95 opacity-0">
    

            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center shadow-lg animate-bounce">
                    <span class="material-icons text-white text-5xl">check</span>
                </div>
            </div>

            <div class="text-center mb-8">
                <h3 class="text-xl text-slate-600 font-medium mb-2">Upgrade Berhasil!</h3>
                <h2 class="text-2xl font-bold text-slate-900 font-display">
                    Anda sekarang Member {{ session('package_name') }}
                </h2>
            </div>

            <div class="border-t border-dashed border-slate-300 my-6"></div>

            <div class="space-y-4 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Ref Number</span>
                    <span class="font-semibold text-slate-800">{{ session('trx_ref') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Waktu Aktivasi</span>
                    <span class="font-semibold text-slate-800">{{ session('trx_time') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-500">Total Bayar</span>
                    <span class="font-semibold text-slate-800">Rp {{ number_format($data['price'], 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ route('properties.create') }}" class="block w-full py-4 bg-primary text-white text-center font-bold rounded-xl hover:bg-primary-hover shadow-lg transition">
                    Tutup
                </a>
            </div>
        </div>
    </div>

    <script>
        // Auto-show Modal jika ada session success
        @if(session('success_transaction'))
            document.addEventListener("DOMContentLoaded", function() {
                const overlay = document.getElementById('paymentOverlay');
                const card = document.getElementById('paymentCard');
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    overlay.classList.remove('opacity-0');
                    card.classList.remove('scale-95', 'opacity-0');
                    card.classList.add('scale-100', 'opacity-100');
                }, 10);
            });
        @endif
        
        // Auto date
        document.addEventListener('DOMContentLoaded', function () {
            const expiryInput = document.getElementById('cardExpiry');
            if (expiryInput) {
                const now = new Date();
                expiryInput.value = (now.getDate()+'').padStart(2,'0') + '/' + (now.getFullYear()+'').slice(-2);
            }
        });
    </script>
</body>
</html>