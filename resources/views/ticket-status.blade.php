<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Cek Status Tiket - Landhub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#1e3a8a",
                        "primary-light": "#3b82f6",
                        "background-light": "#f0f6ff",
                        "card-light": "#ffffff",
                        "text-secondary-light": "#6b7280",
                        "status-bg-light": "#eff6ff",
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                    },
                },
            },
        };
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .timeline-line::before {
            content: '';
            position: absolute;
            top: 8px;
            bottom: -24px;
            left: 5px;
            width: 1px;
            background-color: #e5e7eb;
            height: 160px;
        }
        .timeline-item:last-child .timeline-line::before {
            display: none;
        }
    </style>
</head>
<body class="bg-background-light min-h-screen text-gray-800">

    <header class="bg-gradient-to-l from-[#1e3a8a] to-[#3b82f6] text-white pt-8 pb-32 px-4 sm:px-6 lg:px-8 shadow-md">
        <div class="max-w-4xl mx-auto flex items-center mb-6 space-x-4">
            <a href="{{ route('profil') }}" class="p-2 hover:bg-white/10 transition-colors focus:outline-none">
                <span class="material-icons-outlined text-xl">arrow_back</span>
            </a>
            <h1 class="text-xl sm:text-2xl font-semibold tracking-wide">Cek Status Tiket Layanan</h1>
        </div>
    </header>

    <main class="px-4 sm:px-6 lg:px-8 -mt-32 pb-12">
        <div class="max-w-4xl mx-auto bg-card-light rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-6 sm:p-10">
                <h2 class="text-text-secondary-light text-sm uppercase tracking-wider font-medium mb-6">Detail Tiket</h2>
                
                <div class="bg-status-bg-light rounded-lg p-6 text-center mb-10 border border-blue-50">
                    <p class="text-text-secondary-light text-sm mb-1">Status Terakhir</p>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ $transaction->timelines->first()->title ?? 'Menunggu Proses' }}
                    </p>
                </div>

                <div class="mb-6">
                    
                    <p class="text-text-secondary-light text-sm mb-1">Nomor Tiket Transaksi</p>
                    <p class="font-semibold text-gray-900 text-sm">{{ $transaction->transaction_code }}</p>

                </div>
                <div class="mb-8 border-b border-gray-200 pb-8">
                    <p class="text-text-secondary-light text-sm mb-1">Properti / Layanan</p>
                    <p class="font-semibold text-gray-900 text-sm">{{ $transaction->property->title }}</p>
                    <p class="font-semibold text-gray-900 text-sm">Pengurusan Akte & Balik Nama</p>
                
                </div>

                <div>
                    <h3 class="text-text-secondary-light text-sm mb-6 font-bold">Perjalanan Tiket</h3>
                    <div class="space-y-8 pl-2">
                        
                        @foreach($transaction->timelines as $index => $log)
                        <div class="flex gap-6 timeline-item relative">
                            <div class="w-24 text-right pt-0.5 flex-shrink-0">
                                <div class="text-sm text-gray-500">{{ $log->created_at->format('d M y') }}</div>
                                <div class="text-sm font-semibold text-gray-900">{{ $log->created_at->format('H:i') }}</div>
                            </div>

                            <div class="relative flex flex-col items-center timeline-line">
                                <div class="w-3 h-3 rounded-full mt-1.5 {{ $index === 0 ? 'bg-primary ring-4 ring-blue-100' : 'bg-gray-400' }} z-10"></div>
                            </div>

                            <div class="pt-0.5 pb-8 flex-grow">
                                <p class="font-bold text-gray-900 text-sm">{{ $log->title }}</p>
                                
                                @if($log->description)
                                    <p class="text-sm text-gray-500 mt-1">{{ $log->description }}</p>
                                @endif

                                @if($log->title == 'Tiket Selesai' || $log->status_type == 'finished')
                                    <a class="inline-flex items-center gap-2 mt-3 px-4 py-2 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 text-sm font-bold border border-green-200 transition" href="#">
                                        <span class="material-icons-outlined text-sm">download</span> Lihat Dokumen SHM
                                    </a>
                                @endif
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="h-10"></div>
</body>
</html>