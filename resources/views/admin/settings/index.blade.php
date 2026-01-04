<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Edit Profile - LandHub</title>
    
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#3B82F6", 
                        "primary-dark": "#2563EB", 
                        "dark-blue": "#1e3a8a", 
                        "background-light": "#F3F5F9", 
                        "background-dark": "#0F172A", 
                        "sidebar-light": "#FFFFFF",
                        "sidebar-dark": "#1E293B",
                        "card-light": "#FFFFFF",
                        "card-dark": "#1E293B",
                        "input-border": "#E5E7EB",
                        "input-border-dark": "#374151",
                    },
                    fontFamily: {
                        display: ["Poppins", "sans-serif"],
                        sans: ["Poppins", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.5rem",
                        'xl': '1rem',
                        '2xl': '1.5rem',
                    },
                },
            },
        };
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-sans antialiased text-gray-800 dark:text-gray-200 h-screen overflow-hidden flex transition-colors duration-300">

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
            <a href="{{route('users.index')}}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="font-medium">Users</span>
            </a>
            <a href="{{route ('transactions.index')}}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">Transactions</span>
            </a>
            <a href="{{route ('advertisement.index')}}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                    <span class="font-medium">Advertisement</span>
            </a>
            <a href="{{route('tickets.index')}}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                <span class="font-medium">Tickets</span>
            </a>
        </nav>

        <div class="p-4 border-t border-gray-50 space-y-2">
            <a href="{{route('settings.edit')}}" class="flex items-center px-4 py-3 bg-[#3B82F6] text-white rounded-lg shadow-blue-200 shadow-md transition group">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="font-medium">Settings</span>
            </a>
            <button type="button" onclick="openLogoutModal()" class="flex items-center w-full px-4 py-3 text-gray-500 hover:text-red-600 transition">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="font-medium">Logout</span>
            </button>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-full overflow-hidden">
        
        <header class="h-20 bg-background-light dark:bg-background-dark flex items-center justify-between px-8 md:px-12 flex-shrink-0">
            <button class="md:hidden text-gray-600 dark:text-gray-300">
                <span class="material-icons-outlined">menu</span>
            </button>
            <div class="flex-1"></div> 
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center overflow-hidden border border-gray-300">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=1e3a8a&color=fff" class="w-full h-full object-cover">
                </div>
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Admin</p>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-8 md:px-12">
            <div class="max-w-4xl mx-auto pb-12">
                <h2 class="text-3xl font-bold text-dark-blue dark:text-white text-center mb-8">Edit Profile</h2>
                
                <div class="bg-card-light dark:bg-card-dark rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-8 md:p-12">
                    
                    <form action="{{ route('settings.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                            <label class="md:col-span-3 text-sm font-medium text-gray-900 dark:text-gray-200 tracking-wide" for="name">
                                Nama
                            </label>
                            <div class="md:col-span-9">
                                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" placeholder="Masukan Nama"
                                    class="w-full rounded-lg border-input-border dark:border-input-border-dark bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 text-sm focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-shadow shadow-sm placeholder-gray-400 dark:placeholder-gray-500"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                            <label class="md:col-span-3 text-sm font-medium text-gray-900 dark:text-gray-200 tracking-wide" for="email">
                                Email
                            </label>
                            <div class="md:col-span-9">
                                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" placeholder="Masukan Email"
                                    class="w-full rounded-lg border-input-border dark:border-input-border-dark bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 text-sm focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-shadow shadow-sm placeholder-gray-400 dark:placeholder-gray-500"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                            <label class="md:col-span-3 text-sm font-medium text-gray-900 dark:text-gray-200 tracking-wide" for="phone">
                                Telepon
                            </label>
                            <div class="md:col-span-9">
                                <input id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}" placeholder="Masukan Nomor telepon Aktif"
                                    class="w-full rounded-lg border-input-border dark:border-input-border-dark bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 text-sm focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-shadow shadow-sm placeholder-gray-400 dark:placeholder-gray-500"/>
                            </div>
                        </div>

                        <div class="py-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 text-center leading-relaxed">
                                Jika ingin mengubah kata sandi anda ketik yang baru, Jika tidak biarkan kosong.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                            <label class="md:col-span-3 text-sm font-medium text-gray-900 dark:text-gray-200 tracking-wide" for="password">
                                Password
                            </label>
                            <div class="md:col-span-9">
                                <input id="password" name="password" type="password" placeholder="Masukan Password"
                                    class="w-full rounded-lg border-input-border dark:border-input-border-dark bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 text-sm focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-shadow shadow-sm placeholder-gray-400 dark:placeholder-gray-500"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                            <label class="md:col-span-3 text-sm font-medium text-gray-900 dark:text-gray-200 tracking-wide" for="password_confirmation">
                                Konfirmasi Password
                            </label>
                            <div class="md:col-span-9">
                                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Konfirmasi Ulang Password"
                                    class="w-full rounded-lg border-input-border dark:border-input-border-dark bg-white dark:bg-gray-800 text-gray-900 dark:text-white px-4 py-3 text-sm focus:ring-2 focus:ring-primary focus:border-transparent outline-none transition-shadow shadow-sm placeholder-gray-400 dark:placeholder-gray-500"/>
                            </div>
                        </div>

                        <div class="pt-8 flex justify-center">
                            <button type="submit" class="bg-dark-blue hover:bg-blue-900 text-white font-medium py-3 px-12 rounded-lg shadow-md transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dark-blue">
                                Simpan
                            </button>
                        </div>
                    </form>
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

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3B82F6',
            timer: 3000
        });
    </script>
    @endif

    @if($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            html: '<ul class="text-left text-sm">@foreach($errors->all() as $error)<li>• {{ $error }}</li>@endforeach</ul>',
            confirmButtonColor: '#EF4444'
        });
    </script>
    @endif
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