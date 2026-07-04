<!DOCTYPE html>
<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>LandHub - About Us</title>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#1e40af", // Deep Royal Blue
                        secondary: "#3b82f6", // Brighter Blue for accents
                        "background-light": "#f8fafc", // Slate 50
                        "background-dark": "#0f172a", // Slate 900
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e293b",
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    borderRadius: {
                        DEFAULT: "0.75rem",
                        'xl': "1rem",
                        '2xl': "1.5rem",
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                        'glow': '0 0 15px rgba(59, 130, 246, 0.5)',
                    }
                },
            },
        };
    </script>
<style>::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }
        .dark ::-webkit-scrollbar-thumb {
            background-color: #334155;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-200 font-sans antialiased transition-colors duration-300">
<nav class="sticky top-0 z-50 w-full bg-white/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 transition-colors duration-300">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex justify-between items-center h-20">
<div class="flex-shrink-0 flex items-center gap-2 cursor-pointer group">

<span class="text-2xl font-bold text-slate-900 dark:text-white tracking-tight group-hover:text-primary transition-colors">LandHub</span>
</div>
<div class="hidden md:flex items-center space-x-8">
<a class="text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-white font-medium transition-colors" href="{{ route('landing') }}">Home</a>
<a class="text-primary font-semibold relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:w-full after:h-0.5 after:bg-primary" href="{{ route('about') }}">About Us</a>
<button class="flex items-center justify-center w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-primary hover:text-white transition-all duration-300">
<span class="material-icons-round">person</span>
</button>
</div>
<div class="md:hidden flex items-center">
<button class="text-slate-600 dark:text-slate-300 hover:text-primary focus:outline-none">
<span class="material-icons-round text-3xl">menu</span>
</button>
</div>
</div>
</div>
</nav>
<section class="relative overflow-hidden pt-16 pb-24 lg:pt-32 lg:pb-32">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
<div class="space-y-8 animate-fade-in-up">
<h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                        About <span class="text-primary">LandHub</span>
</h1>
<div class="w-20 h-1.5 bg-primary rounded-full"></div>
<p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed text-justify">
                        LandHub merupakan sebuah platform online yang mempertemukan penjual dan pembeli lahan secara transparan, mudah, dan aman. Aplikasi ini memanfaatkan teknologi digital dan peta interaktif untuk membantu pengguna menemukan lahan yang sesuai dengan kebutuhan mereka baik untuk perumahan, investasi, maupun usaha.
                    </p>
</div>
<div class="relative flex justify-center items-center lg:justify-end">
<div class="absolute w-96 h-96 bg-blue-100 dark:bg-blue-900/20 rounded-full blur-3xl -z-10 animate-pulse"></div>
<div class="relative bg-white dark:bg-surface-dark p-8 rounded-3xl shadow-soft border border-slate-100 dark:border-slate-700 transform hover:scale-105 transition-transform duration-500">
<div class="flex flex-col items-center">
<span class="material-icons-round text-8xl text-primary mb-2">roofing</span>
<h2 class="text-4xl font-bold text-slate-900 dark:text-white tracking-tighter">LandHub</h2>
<p class="text-slate-400 dark:text-slate-500 tracking-[0.5em] text-sm uppercase mt-1 font-semibold">Property</p>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="py-24 bg-blue-50/50 dark:bg-slate-900/50 relative">
<div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-slate-300 dark:via-slate-700 to-transparent"></div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center max-w-3xl mx-auto mb-16">
<h2 class="text-4xl font-bold text-slate-900 dark:text-white mb-6">Profile Team</h2>
<p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed">
                    Tim LandHub terdiri dari orang-orang yang penuh semangat dan siap membantu mewujudkan kebutuhan anda.
                </p>
</div>
<div class="flex flex-col gap-8">
<div class="flex flex-wrap justify-center gap-8">
<div class="group bg-white dark:bg-surface-dark rounded-2xl shadow-soft hover:shadow-2xl hover:shadow-blue-500/10 dark:hover:shadow-blue-900/20 border border-slate-100 dark:border-slate-800 p-8 w-full sm:w-80 flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
<div class="relative w-32 h-32 mb-6 rounded-full overflow-hidden border-4 border-blue-50 dark:border-slate-700 group-hover:border-primary transition-colors">
<img alt="Yogi Fadli Sujila" class="w-full h-full object-cover" src="https://media.canva.com/v2/image-resize/format:JPG/height:275/quality:92/uri:ifs%3A%2F%2FM%2F4238d43a-2f95-4cb6-a6b3-eca003292dc7/watermark:F/width:275?csig=AAAAAAAAAAAAAAAAAAAAADe7qFhhUo13YeHHoGQGM1E67RbYzFiPZJWPzpIP0T7t&exp=1783207282&osig=AAAAAAAAAAAAAAAAAAAAAEqPiMn_6xym_NUfUNjtooFlP2aGihusnd6XSzfLE-iJ&signer=media-rpc&x-canva-quality=screen"/>
</div>
<h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1">Yogi Fadli Sujila</h3>
<p class="text-xs font-bold tracking-wider text-primary uppercase mb-4">Chief Executive Officer</p>
<div class="flex gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<a class="text-slate-400 hover:text-primary transition-colors" href="#"><i class="material-icons-round text-sm">email</i></a>
<a class="text-slate-400 hover:text-primary transition-colors" href="#"><i class="material-icons-round text-sm">link</i></a>
</div>
</div>
<div class="group bg-white dark:bg-surface-dark rounded-2xl shadow-soft hover:shadow-2xl hover:shadow-blue-500/10 dark:hover:shadow-blue-900/20 border border-slate-100 dark:border-slate-800 p-8 w-full sm:w-80 flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
<div class="relative w-32 h-32 mb-6 rounded-full overflow-hidden border-4 border-blue-50 dark:border-slate-700 group-hover:border-primary transition-colors">
<img alt="Adis Supriadi" class="w-full h-full object-cover" src="https://media.canva.com/v2/image-resize/format:JPG/height:290/quality:92/uri:ifs%3A%2F%2FM%2Fbca70b00-ca0d-4486-945a-469eadf19496/watermark:F/width:221?csig=AAAAAAAAAAAAAAAAAAAAAHiPW-1E4fNPpi3t1ciRK7_JBDW3Ih9Tt5iVdUGBW_xV&exp=1783206681&osig=AAAAAAAAAAAAAAAAAAAAAMEK2Sn14z4qWYsxmcRSuCBcPZY943cA2l74fvbHwVIr&signer=media-rpc&x-canva-quality=screen"/>
</div>
<h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1">Adis Supriadi</h3>
<p class="text-xs font-bold tracking-wider text-primary uppercase mb-4">Chief Technology Officer</p>
<div class="flex gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<a class="text-slate-400 hover:text-primary transition-colors" href="#"><i class="material-icons-round text-sm">email</i></a>
<a class="text-slate-400 hover:text-primary transition-colors" href="#"><i class="material-icons-round text-sm">link</i></a>
</div>
</div>
</div>
<div class="flex flex-wrap justify-center gap-8">
<div class="group bg-white dark:bg-surface-dark rounded-2xl shadow-soft hover:shadow-2xl hover:shadow-blue-500/10 dark:hover:shadow-blue-900/20 border border-slate-100 dark:border-slate-800 p-8 w-full sm:w-80 flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
<div class="relative w-32 h-32 mb-6 rounded-full overflow-hidden border-4 border-blue-50 dark:border-slate-700 group-hover:border-primary transition-colors">
<img alt="Muhammad Syakar Abdillah" class="w-full h-full object-cover" src="https://media.canva.com/v2/image-resize/format:JPG/height:800/quality:92/uri:ifs%3A%2F%2FM%2Fa06ffa96-c3f8-4339-8490-97b0b7398142/watermark:F/width:600?csig=AAAAAAAAAAAAAAAAAAAAAOdONCo6j0gc8yIAVJFmh4QJNwVNlyciQi8elLORQXj_&exp=1783208403&osig=AAAAAAAAAAAAAAAAAAAAAMznIn1yv9RGuLZdZHotbkrs0RBhQlWwc8uXR38wTdKz&signer=media-rpc&x-canva-quality=screen"/>
</div>
<h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1">Muhammad Syakar A.</h3>
<p class="text-xs font-bold tracking-wider text-primary uppercase mb-4">Chief Financial Officer</p>
<div class="flex gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<a class="text-slate-400 hover:text-primary transition-colors" href="#"><i class="material-icons-round text-sm">email</i></a>
<a class="text-slate-400 hover:text-primary transition-colors" href="#"><i class="material-icons-round text-sm">link</i></a>
</div>
</div>
<div class="group bg-white dark:bg-surface-dark rounded-2xl shadow-soft hover:shadow-2xl hover:shadow-blue-500/10 dark:hover:shadow-blue-900/20 border border-slate-100 dark:border-slate-800 p-8 w-full sm:w-80 flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
<div class="relative w-32 h-32 mb-6 rounded-full overflow-hidden border-4 border-blue-50 dark:border-slate-700 group-hover:border-primary transition-colors">
<img alt="Dini Andriati" class="w-full h-full object-cover" src="https://media.canva.com/v2/image-resize/format:JPG/height:325/quality:92/uri:ifs%3A%2F%2FM%2Ffd697ae5-9f3a-4a35-84b0-5cc73b97548b/watermark:F/width:244?csig=AAAAAAAAAAAAAAAAAAAAAHdM0iNBvjrmbjaFy50_nL2Wffn5NUvUXnfO0LVZpfXL&exp=1783207064&osig=AAAAAAAAAAAAAAAAAAAAAOMlfX0rwNGJ4obONp8FNahNhaYlBZeQqkBtdI_FMBjZ&signer=media-rpc&x-canva-quality=screen"/>
</div>
<h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1">Dini Andriati</h3>
<p class="text-xs font-bold tracking-wider text-primary uppercase mb-4">Chief Market Officer</p>
<div class="flex gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<a class="text-slate-400 hover:text-primary transition-colors" href="#"><i class="material-icons-round text-sm">email</i></a>
<a class="text-slate-400 hover:text-primary transition-colors" href="#"><i class="material-icons-round text-sm">link</i></a>
</div>
</div>
<div class="group bg-white dark:bg-surface-dark rounded-2xl shadow-soft hover:shadow-2xl hover:shadow-blue-500/10 dark:hover:shadow-blue-900/20 border border-slate-100 dark:border-slate-800 p-8 w-full sm:w-80 flex flex-col items-center text-center transition-all duration-300 hover:-translate-y-2">
<div class="relative w-32 h-32 mb-6 rounded-full overflow-hidden border-4 border-blue-50 dark:border-slate-700 group-hover:border-primary transition-colors">
<img alt="Rama Maulana Nurrahman" class="w-full h-full object-cover" src="https://media.canva.com/v2/image-resize/format:JPG/height:800/quality:92/uri:ifs%3A%2F%2FM%2F92086f1d-4cf2-4387-9b19-70803ea09d52/watermark:F/width:600?csig=AAAAAAAAAAAAAAAAAAAAABeJORh2Luf2vcXkut0QxTIxCHlDFJXNGS45umm8tav9&exp=1783208442&osig=AAAAAAAAAAAAAAAAAAAAAGU_g9jkZmYJhzSw5NW757aBnkgCKX2tfb0zBQ5z7JmK&signer=media-rpc&x-canva-quality=screen"/>
</div>
<h3 class="text-xl font-bold text-slate-900 dark:text-white mb-1">Rama Maulana N.</h3>
<p class="text-xs font-bold tracking-wider text-primary uppercase mb-4">Chief Operating Officer</p>
<div class="flex gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
<a class="text-slate-400 hover:text-primary transition-colors" href="#"><i class="material-icons-round text-sm">email</i></a>
<a class="text-slate-400 hover:text-primary transition-colors" href="#"><i class="material-icons-round text-sm">link</i></a>
</div>
</div>
</div>
</div>
</div>
</section>
<footer class="bg-white border-t border-gray-200 py-8 md:py-12">
    <div class="px-4 sm:px-6 md:px-12 max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center md:items-start text-center md:text-left gap-6 md:gap-8">
        <div>
            <h2 class="text-2xl font-extrabold text-[#1E2B58] mb-2">LandHub</h2>
            <p class="text-xs text-gray-500 max-w-xs">
                Temukan lahan impianmu di LandHub.
            </p>
        </div>

        <div>
            <h4 class="font-bold text-sm mb-4">Tentang Kami</h4>
            <ul class="space-y-2 text-xs text-gray-500">
                <li><a href="#" class="hover:text-blue-600">Mahasiswa Informatika</a></li>
                <li><a href="#" class="hover:text-blue-600">Universitas Sebelas April</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-bold text-sm mb-4">Hubungi Kami</h4>
            <ul class="space-y-2 text-xs text-gray-500">
                <li>info@landhub.com</li>
                <li>+62 89676300163</li>
            </ul>
        </div>
    </div>
</footer>

</body></html>
