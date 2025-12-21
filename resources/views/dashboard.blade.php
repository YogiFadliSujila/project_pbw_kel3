<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - LandHub</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F9FE] text-gray-800">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white border-r border-gray-100 hidden md:flex flex-col flex-shrink-0 z-20">
            <div class="h-20 flex items-center px-8 border-b border-gray-50">
                <h1 class="text-2xl font-bold text-[#1E2B58]">LandHub</h1>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 bg-[#3B82F6] text-white rounded-lg shadow-blue-200 shadow-md transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('properties.index') }}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="font-medium">Properties</span>
                </a>

                <a href="{{route('users.index')}}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="font-medium">Users</span>
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">Transactions</span>
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                    <span class="font-medium">Advertisement</span>
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    <span class="font-medium">Tickets</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-50 space-y-2">
                <a href="#" class="flex items-center px-4 py-3 text-gray-500 hover:text-[#1E2B58] transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="font-medium">Settings</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-3 text-gray-500 hover:text-red-600 transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto bg-[#F8F9FE] p-8">
            
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-bold text-[#1E2B58]">Dashboard</h2>
                
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name ?? 'Budi' }}</p>
                        <p class="text-xs text-gray-500">Admin</p>
                    </div>
                    <div class="w-10 h-10 rounded-full border-2 border-white shadow-sm overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Budi' }}&background=0D8ABC&color=fff" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total User</p>
                            <h3 class="text-3xl font-bold text-[#1E2B58] mt-2">121212</h3>
                        </div>
                        <div class="bg-[#EBE9FE] p-3 rounded-2xl text-[#6D5DD3]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-500 font-bold flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            8.5%
                        </span>
                        <span class="text-gray-400 ml-2">Up from yesterday</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Properties</p>
                            <h3 class="text-3xl font-bold text-[#1E2B58] mt-2">10,293</h3>
                        </div>
                        <div class="bg-[#FFF8DD] p-3 rounded-2xl text-[#FFCE73]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-500 font-bold flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            1.3%
                        </span>
                        <span class="text-gray-400 ml-2">Up from past week</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Sales</p>
                            <h3 class="text-3xl font-bold text-[#1E2B58] mt-2">16</h3>
                        </div>
                        <div class="bg-[#DCFCE7] p-3 rounded-2xl text-[#22C55E]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-red-500 font-bold flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
                            4%
                        </span>
                        <span class="text-gray-400 ml-2">Down from past month</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Pending</p>
                            <h3 class="text-3xl font-bold text-[#1E2B58] mt-2">793</h3>
                        </div>
                        <div class="bg-[#FFEDD5] p-3 rounded-2xl text-[#FB923C]">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        <span class="text-green-500 font-bold flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            1.8%
                        </span>
                        <span class="text-gray-400 ml-2">Up from yesterday</span>
                    </div>
                </div>

            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
                <h3 class="text-xl font-bold text-[#1E2B58] mb-6">Total Transaction Details</h3>
                
                <div class="w-full h-80">
                    <canvas id="transactionChart"></canvas>
                </div>
            </div>

        </main>
    </div>

    <script>
        const ctx = document.getElementById('transactionChart').getContext('2d');
        
        // Buat gradien warna biru untuk area bawah grafik
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.2)'); // Biru terang
        gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');   // Transparan

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Des'],
                datasets: [{
                    label: 'Transactions',
                    data: [12, 19, 10, 25, 15, 20, 10, 25, 22, 18, 25, 18], // Data dummy mirip gambar
                    borderColor: '#3B82F6', // Warna garis biru
                    backgroundColor: gradient, // Warna isi gradien
                    borderWidth: 2,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#3B82F6',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.4, // Membuat garis melengkung (smooth)
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Sembunyikan legend agar bersih seperti desain
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#F3F4F6', // Warna grid tipis
                            borderDash: [5, 5]
                        },
                        ticks: {
                            color: '#9CA3AF' // Warna text axis
                        }
                    },
                    x: {
                        grid: {
                            display: false // Hilangkan grid vertikal
                        },
                        ticks: {
                            color: '#9CA3AF'
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>