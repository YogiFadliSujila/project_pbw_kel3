<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Kategori Iklan - LandHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-[#F8F9FE] text-slate-800">

    <div class="max-w-7xl mx-auto px-6 py-8 flex items-center relative">
        <a href="{{ url()->previous() }}" class="absolute left-6 p-2 hover:bg-gray-100 rounded-full transition">
            <span class="material-icons-outlined text-2xl text-slate-900">arrow_back</span>
        </a>
        <h1 class="text-2xl md:text-3xl font-bold text-[#1E2B58] w-full text-center">Detail Kategori Iklan</h1>
    </div>

    <main class="max-w-5xl mx-auto px-6 pb-20 space-y-8">

        <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-indigo-50 hover:shadow-md transition">
            <div class="flex flex-col md:flex-row gap-8 items-center">
                <div class="w-full md:w-1/3 h-48 rounded-2xl bg-gradient-to-br from-[#7F9FD6] to-[#5A7EBF] p-6 text-white flex flex-col justify-between shadow-lg relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full transform translate-x-10 -translate-y-10"></div>
                    <div>
                        <h2 class="text-3xl font-bold">Basic</h2>
                        <div class="w-12 h-1 bg-white mt-2 rounded-full"></div>
                    </div>
                    <div>
                        <p class="font-bold text-lg">Bebas Biaya</p>
                        <p class="text-xs text-blue-100 mt-1 opacity-90">Cocok untuk Penjual Individu atau Pemula</p>
                    </div>
                </div>

                <div class="flex-1 space-y-4">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Keuntungan Tingkatan:</h3>
                    <ul class="space-y-3 text-sm text-slate-600">
                        <li class="flex items-start gap-3">
                            <span class="material-icons-outlined text-blue-500 text-lg">check_circle</span>
                            <span>Maksimal <strong class="text-slate-800">3x unggahan</strong> properti yang dapat diunggah pada platform ini.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-icons-outlined text-blue-500 text-lg">timer_off</span>
                            <span>Unggahan akan <strong class="text-slate-800">otomatis terhapus</strong> oleh sistem ketika sudah melewati 2 bulan tayangan.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-icons-outlined text-blue-500 text-lg">sort</span>
                            <span>Properti ditampilkan sesuai urutan waktu unggahan (tidak prioritas).</span>
                        </li>
                    </ul>
                    <div class="pt-4">
                        <form action="{{ route('membership.process') }}" method="POST"> 
                            @csrf
                            <input type="hidden" name="package" value="Basic">
                            <button type="button" class="px-6 py-3 bg-gray-100 text-slate-600 font-bold rounded-xl hover:bg-gray-200 transition w-full md:w-auto">
                                Pilih Paket Basic
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 hover:shadow-md transition">
            <div class="flex flex-col md:flex-row gap-8 items-center">
                <div class="w-full md:w-1/3 h-48 rounded-2xl bg-gradient-to-br from-gray-400 to-gray-600 p-6 text-white flex flex-col justify-between shadow-lg relative overflow-hidden">
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-black opacity-10 rounded-full"></div>
                    <div>
                        <h2 class="text-3xl font-bold">Silver</h2>
                        <div class="w-12 h-1 bg-white mt-2 rounded-full"></div>
                    </div>
                    <div>
                        <p class="font-bold text-lg">Rp 679.000 <span class="text-xs font-normal opacity-80">/ 3 bulan</span></p>
                        <p class="text-xs text-gray-100 mt-1 opacity-90">Cocok untuk Pengembang Skala Kecil</p>
                    </div>
                </div>

                <div class="flex-1 space-y-4">
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Keuntungan Tingkatan:</h3>
                    <ul class="space-y-3 text-sm text-slate-600">
                        <li class="flex items-start gap-3">
                            <span class="material-icons-outlined text-gray-500 text-lg">trending_up</span>
                            <span>Properti <strong class="text-slate-800">diprioritaskan</strong> dan ditampilkan di urutan paling awal pada hasil pencarian.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-icons-outlined text-gray-500 text-lg">layers</span>
                            <span>Maksimal <strong class="text-slate-800">5x unggahan</strong> properti.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-icons-outlined text-gray-500 text-lg">all_inclusive</span>
                            <span>Unggahan <strong class="text-slate-800">selamanya ada</strong> (tidak expired), kecuali properti sudah terjual.</span>
                        </li>
                    </ul>
                    <div class="pt-4">
                        <a href="{{ route('membership.payment', ['package' => 'Silver']) }}" class="inline-block px-6 py-3 bg-gray-800 text-white font-bold rounded-xl hover:bg-gray-900 transition w-full md:w-auto text-center shadow-lg shadow-gray-200">
                            Beli Paket Silver
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 md:p-8 shadow-md border border-yellow-100 hover:shadow-lg transition transform hover:-translate-y-1">
            <div class="flex flex-col md:flex-row gap-8 items-center">
                <div class="w-full md:w-1/3 h-48 rounded-2xl bg-gradient-to-br from-yellow-400 to-yellow-600 p-6 text-white flex flex-col justify-between shadow-xl shadow-yellow-100 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, #fff 2px, transparent 2.5px); background-size: 20px 20px;"></div>
                    <div>
                        <h2 class="text-4xl font-bold">Gold</h2>
                        <div class="w-12 h-1 bg-white mt-2 rounded-full"></div>
                    </div>
                    <div>
                        <p class="font-bold text-xl">Rp 779.000 <span class="text-sm font-normal opacity-80">/ 6 bulan</span></p>
                        <p class="text-xs text-yellow-50 mt-1 opacity-90">Cocok untuk Pengembang Besar</p>
                    </div>
                </div>

                <div class="flex-1 space-y-4">
                    <h3 class="text-sm font-bold text-yellow-500 uppercase tracking-wider mb-2">Keuntungan Tingkatan:</h3>
                    <ul class="space-y-3 text-sm text-slate-600">
                        <li class="flex items-start gap-3">
                            <span class="material-icons-outlined text-yellow-500 text-lg">stars</span>
                            <span>Properti <strong class="text-slate-800">selalu diprioritaskan</strong> di urutan teratas.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-icons-outlined text-yellow-500 text-lg">all_inclusive</span>
                            <span><strong class="text-slate-800">Tidak ada batasan</strong> jumlah properti (Unlimited).</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-icons-outlined text-yellow-500 text-lg">campaign</span>
                            <span>Tampil dalam bentuk <strong class="text-slate-800">brosur promo</strong> di homepage LandHub.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-icons-outlined text-yellow-500 text-lg">notifications_active</span>
                            <span><strong class="text-slate-800">Pop-Up notifikasi</strong> iklan muncul otomatis ke pengguna lain.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-icons-outlined text-yellow-500 text-lg">support_agent</span>
                            <span>Layanan dukungan lebih cepat & diprioritaskan.</span>
                        </li>
                    </ul>
                    <div class="pt-4">
                        <a href="{{ route('membership.payment', ['package' => 'Gold']) }}" class="inline-block px-8 py-4 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white font-bold rounded-xl hover:shadow-lg hover:from-yellow-600 hover:to-yellow-700 transition w-full md:w-auto text-center shadow-yellow-200">
                            Beli Paket Gold
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>

</body>
</html>