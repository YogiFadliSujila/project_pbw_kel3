<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions Log - LandHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-[#F8F9FE] text-gray-800">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white border-r border-gray-100 hidden md:flex flex-col flex-shrink-0 z-20">
            <div class="h-20 flex items-center px-8 border-b border-gray-50">
                <h1 class="text-2xl font-bold text-[#1E2B58]">LandHub</h1>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('properties.index') }}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="font-medium">Properties</span>
                </a>

                <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="font-medium">Users</span>
                </a>

                <a href="{{ route('transactions.index') }}" class="flex items-center px-4 py-3 bg-[#3B82F6] text-white rounded-lg shadow-blue-200 shadow-md transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">Transactions</span>
                </a>

                <a href="{{route('advertisement.index')}}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                    <span class="font-medium">Advertisement</span>
                </a>
                
                <a href="{{route('tickets.index')}}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    <span class="font-medium">Tickets</span>
                </a>
            </nav>
            <div class="p-4 border-t border-gray-50 space-y-2">
                <a href="{{route('settings.edit')}}" class="flex items-center px-4 py-3 text-gray-500 hover:text-[#1E2B58] transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="font-medium">Settings</span>
                </a>
                <button type="button" onclick="openLogoutModal()" class="flex items-center w-full px-4 py-3 text-gray-500 hover:text-red-600 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="font-medium">Logout</span>
                </button>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto bg-[#F8F9FE] p-8">
            
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-bold text-[#1E2B58]">Transactions</h2>
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Admin</p>
                    </div>
                    <div class="w-10 h-10 rounded-full border-2 border-white shadow-sm overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D8ABC&color=fff" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Transactions</p>
                            <h3 class="text-3xl font-bold text-[#1E2B58] mt-2">{{ number_format($totalTransactions) }}</h3>
                        </div>
                        <div class="bg-blue-50 p-3 rounded-2xl text-blue-400">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="{{ $txGrowth >= 0 ? 'text-green-500' : 'text-red-500' }} font-bold flex items-center gap-1">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $txGrowth >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}"></path>
                             </svg>
                            {{ abs($txGrowth) }}%
                        </span>
                        <span class="text-gray-400 ml-2">From past week</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Revenue (10%)</p>
                            <h3 class="text-3xl font-bold text-[#1E2B58] mt-2">
                                @if($totalRevenue >= 1000000000)
                                    IDR {{ number_format($totalRevenue / 1000000000, 1, ',', '.') }} B
                                @elseif($totalRevenue >= 1000000)
                                    IDR {{ number_format($totalRevenue / 1000000, 1, ',', '.') }} M
                                @else
                                    IDR {{ number_format($totalRevenue, 0, ',', '.') }}
                                @endif
                            </h3>
                        </div>
                        <div class="bg-green-50 p-3 rounded-2xl text-green-400">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                         <span class="{{ $revGrowth >= 0 ? 'text-green-500' : 'text-red-500' }} font-bold flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $revGrowth >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}"></path>
                            </svg>
                            {{ abs($revGrowth) }}%
                        </span>
                        <span class="text-gray-400 ml-2">From past week</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Active Buyers</p>
                            <h3 class="text-3xl font-bold text-[#1E2B58] mt-2">{{ number_format($activeBuyers) }}</h3>
                        </div>
                        <div class="bg-purple-50 p-3 rounded-2xl text-purple-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="{{ $buyersGrowth >= 0 ? 'text-green-500' : 'text-red-500' }} font-bold flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $buyersGrowth >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}"></path>
                            </svg>
                            {{ abs($buyersGrowth) }}%
                        </span>
                        <span class="text-gray-400 ml-2">From past week</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">This Month</p>
                        <h3 class="text-3xl font-bold text-[#1E2B58] mt-2">{{ number_format($thisMonthCount) }}</h3>
                        <div class="mt-4 flex items-center text-sm">
                            <span class="{{ $monthGrowth >= 0 ? 'text-green-500' : 'text-red-500' }} font-bold flex items-center gap-1">
                                {{ $monthGrowth >= 0 ? '+' : '' }}{{ $monthGrowth }}%
                            </span>
                            <span class="text-gray-400 ml-2">vs last month</span>
                        </div>
                    </div>
                    <div class="bg-orange-50 p-3 rounded-2xl text-orange-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="pt-6 pr-6 pl-6 pb-3 flex flex-col md:flex-row justify-between items-center gap-4">
                    <h3 class="text-xl font-bold text-[#1E2B58]">Transaction Logs</h3>
                    <button class="px-4 py-2 bg-[#3B82F6] text-white text-sm font-medium rounded-lg hover:bg-blue-600 transition flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Add New Transaction
                    </button>
                </div>

                <form method="GET" action="{{ route('transactions.index') }}" class="pt-3 pr-6 pl-6 pb-3 flex flex-col md:flex-row gap-4 justify-between items-center">
    
                    <div class="relative w-full md:w-full">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                        <input type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Search" 
                            class="w-full bg-gray-100 pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="w-full md:w-48">
                        <select name="status" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-500 focus:outline-none bg-gray-100">
                            <option value="All Status" {{ request('status') == 'All' ? 'selected' : '' }}>All Status</option>
                            <option value="Success" {{ request('status') == 'Success' ? 'selected' : '' }}>Success</option>
                        </select>
                    </div>
                </form>

                <div class="pt-3 pr-6 pl-6 pb-3 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-900 text-xs font-bold tracking-wider">
                                <th class="px-6 py-4 rounded-l-xl">Id Transaction</th>
                                <th class="px-6 py-4">Id Property</th>
                                <th class="px-6 py-4">Buyer</th>
                                <th class="px-6 py-4">Date Buy</th>
                                <th class="px-6 py-4">Price</th>
                                <th class="px-6 py-4 text-center rounded-r-xl">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($transactions as $trx)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $trx->transaction_code }}
                                </td>
                                
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    LH{{ str_pad($trx->property_id, 4, '0', STR_PAD_LEFT) }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center text-xs font-bold uppercase">
                                            {{ substr($trx->user->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $trx->user->name }}</p>
                                            <p class="text-xs text-gray-400">{{ $trx->user->email }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $trx->created_at->format('Y-m-d') }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    IDR {{ number_format($trx->price, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-500 text-white ">
                                        {{ $trx->status }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada data transaksi.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $transactions->links() }}
                </div>
            </div>

        </main>
    </div>
    <div id="logoutModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0">
        <div class="bg-gray-800 rounded-3xl shadow-2xl p-8 w-full max-w-md transform scale-95 transition-transform duration-300 text-center relative">
            
            <h3 class="text-2xl md:text-3xl font-bold text-white mb-8 leading-snug tracking-tight">
                Are you sure you want <br> to log out?
            </h3>
            
            <div class="flex items-center justify-center gap-6 ">
                <button onclick="confirmLogout()" class="w-48 py-3 rounded-2xl bg-white text-gray-800 font-bold text-lg hover:bg-gray-50 transition-colors shadow-lg">
                    Logout
                </button>
                
                <button onclick="closeLogoutModal()" class="w-48 py-3 rounded-2xl bg-white text-gray-800 font-bold text-lg hover:bg-gray-50 transition-colors shadow-lg">
                    Cancel
                </button>
            </div>
        </div>
    </div>
    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
        @csrf
    </form>
    <script>
        const modal = document.getElementById('logoutModal');
        const modalContent = modal.querySelector('div'); // Div pembungkus putih
        function openLogoutModal() {
            modal.classList.remove('hidden');
            // Animasi Fade In (tunggu sebentar agar class hidden hilang dulu)
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        function closeLogoutModal() {
            // Animasi Fade Out
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Sesuaikan durasi transition-opacity
        }

        function confirmLogout() {
            document.getElementById('logout-form').submit();
        }

        // Tutup modal jika klik di luar area putih (backdrop)
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeLogoutModal();
            }
        });
    </script>
</body>
</html>