<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - LandHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-[#EAF0F6] min-h-screen w-full flex flex-col items-center justify-center p-4 md:p-8">

    <div class="w-full max-w-6xl flex flex-col gap-8">

        <div class="w-full relative flex flex-col md:flex-row items-center justify-center md:justify-between">
            <div class="w-full md:w-auto flex justify-start md:absolute md:left-0 md:top-1/2 md:-translate-y-1/2 mb-4 md:mb-0 px-4 md:px-0">
                <a href="/" class="inline-block text-black hover:opacity-70 transition">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 12H5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 19L5 12L12 5" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-black text-center w-full">
                Form Registrasi
            </h1>
            <div class="hidden md:block w-[32px]"></div>
        </div>

        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16 items-start">

            <div class="flex flex-col justify-center px-4 w-full max-w-lg mx-auto md:mx-0 md:ml-auto">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-lg font-medium text-black mb-2">Nama Lengkap</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Masukan Nama Lengkap" required autofocus
                               class="w-full bg-white border border-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg px-6 py-4 text-gray-700 placeholder-gray-400 outline-none transition shadow-sm">
                        @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="email" class="block text-lg font-medium text-black mb-2">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Masukan Email" required
                               class="w-full bg-white border border-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg px-6 py-4 text-gray-700 placeholder-gray-400 outline-none transition shadow-sm">
                        @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-lg font-medium text-black mb-2">Nomor Telepon</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}" placeholder="Masukan Nomor Telepon" required
                               class="w-full bg-white border border-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg px-6 py-4 text-gray-700 placeholder-gray-400 outline-none transition shadow-sm">
                        @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password" class="block text-lg font-medium text-black mb-2">Password</label>
                        <input id="password" name="password" type="password" placeholder="Password" required
                               class="w-full bg-white border border-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg px-6 py-4 text-gray-700 placeholder-gray-400 outline-none transition shadow-sm">
                        @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-lg font-medium text-black mb-2">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Konfirmasi Password" required
                               class="w-full bg-white border border-transparent focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg px-6 py-4 text-gray-700 placeholder-gray-400 outline-none transition shadow-sm">
                    </div>

                    <button type="submit" class="w-full bg-[#1E2B58] hover:bg-[#162044] text-white font-bold py-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 text-lg">
                        Daftar
                    </button>

                    <div class="relative flex py-2 items-center">
                        <div class="flex-grow border-t border-gray-300"></div>
                        <span class="flex-shrink-0 mx-4 text-gray-500 text-sm font-medium">Atau</span>
                        <div class="flex-grow border-t border-gray-300"></div>
                    </div>

                    <button type="button" class="w-full bg-white hover:bg-gray-50 text-gray-600 font-medium py-4 rounded-lg shadow-sm border border-transparent hover:border-gray-200 transition flex items-center justify-center gap-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M23.766 12.2764C23.766 11.4607 23.6999 10.6406 23.5588 9.83807H12.24V14.4591H18.7217C18.4528 15.9494 17.5885 17.2678 16.323 18.1056V21.1039H20.19C22.4608 19.0139 23.766 15.9274 23.766 12.2764Z" fill="#4285F4"/><path d="M12.2401 24.0008C15.4766 24.0008 18.2059 22.9382 20.1945 21.1039L16.3275 18.1055C15.2517 18.8375 13.8627 19.252 12.2445 19.252C9.11388 19.252 6.45946 17.1399 5.50705 14.3003H1.5166V17.3912C3.55371 21.4434 7.7029 24.0008 12.2401 24.0008Z" fill="#34A853"/><path d="M5.50253 14.3003C5.00236 12.8099 5.00236 11.1961 5.50253 9.70575V6.61481H1.51649C-0.18551 10.0056 -0.18551 14.0004 1.51649 17.3912L5.50253 14.3003Z" fill="#FBBC05"/><path d="M12.2401 4.74966C13.9509 4.7232 15.6044 5.36697 16.8434 6.54867L20.2695 3.12262C18.1001 1.0855 15.2208 -0.034466 12.2401 0.000808666C7.7029 0.000808666 3.55371 2.55822 1.5166 6.61481L5.50264 9.70575C6.45064 6.86173 9.10947 4.74966 12.2401 4.74966Z" fill="#EA4335"/></svg>
                        Daftar dengan akun google
                    </button>

                    <div class="text-center mt-6">
                        <p class="text-gray-600 text-sm">
                            Sudah Punya Akun? <a href="{{ route('login') }}" class="text-blue-700 font-bold hover:underline">Masuk</a>
                        </p>
                    </div>
                </form>
            </div>

        <div class="hidden md:flex flex-col items-center justify-center h-full pl-8">
            <div class="relative w-80 h-80 md:w-80 md:h-80">
                <svg viewBox="16 50 200 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full drop-shadow-xl">
                    <path d="M25 122 V 83 L 70 40 L 115 79" stroke="#1E2B58" stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
                    <text x="50" y="115" font-family="'Inter', sans-serif" font-weight="800" font-size="38" fill="#1E2B58">LandHub</text>
                    <text x="135" y="135" font-family="'Inter', sans-serif" font-weight="500" font-size="12" letter-spacing="0.2em" fill="#586486">Property</text>
                </svg>
            </div>
        </div>

        </div>

    </div>

</body>
</html>
