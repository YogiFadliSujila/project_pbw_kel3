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
<span class="material-icons-round text-primary text-4xl group-hover:scale-110 transition-transform">home_work</span>
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
<div class="flex flex-wrap gap-4 pt-4">
<button class="px-8 py-3 bg-primary text-white font-semibold rounded-full shadow-lg shadow-primary/30 hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300">
                            Learn More
                        </button>
<button class="px-8 py-3 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-700 font-semibold rounded-full hover:border-primary hover:text-primary dark:hover:border-primary dark:hover:text-primary transition-all duration-300 flex items-center gap-2">
<span class="material-icons-round text-sm">play_arrow</span> Watch Video
                        </button>
</div>
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
<img alt="Yogi Fadli Sujila" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDq40GMoNLa4zjMq35W_je6CpFrIsv6JnfKK8jW9F4YXCpHxJXo9UqWzjUDcx9wiDHOysp8H4w41LPbWLfIcZy768L4BG5VgYlQ-UjIBisSxJIw9d_MQAlrpiO6HcyaNmlU2rnRTgfdxmtFH14gi-W95UTHc1aO-Ps9V_2l-F76aMAS8HVLGZCeXW_nW__xNnvNgZ1rkeTWzWF7sJ_ZBo-nVCcW0Ejo4G_xjbPBubJo1uDljBoO-3uIPVbq-drVBmZVdksF5R-2yzo"/>
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
<img alt="Adis Supriadi" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA1gJU2G0p2zHjMrZ-n8Yyz2r3QN1wK53KKnbMOVnLfpclZCeOKD-7KUwfKHTsqCfHpYQBL_RGi1WHwLKRcAlyjr6ixWwCfSqQ1awGaWRFCQMx5pySbur79h9mZWxJxRufctKtbhgHBc7RmajDtkOmLxKFCwAJ0J3tkzaKvAdf1vvgyJuJsKWWuOXMFHRXu-Vi-A109n9VSj_aRTb236XCKru6hlKZSbFsOPAuzDgKZ82QnnDeTNpJ1vfarx1OWQ9bXj3Z9yftStwA"/>
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
<img alt="Muhammad Syakar Abdillah" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDPLlLgMTOrZyW_KVWqDtlzpvjAeJArfWfCsqQ2oz31FZpmRt707_Vj3PClHYlyW0tVFfnLBnT_1ImMqIrp4gUOPkqo1FHzuTN_aolvpqB-Xj4huDdwSyBBDVV2TX7Nt_DuPqYpExMQqzlzrVs5KMpv36bWtsBRPKOI0nKUDuwEvC_ZCFFmS0GsKLDxzzqEbWgXVBLphltW7bSyFeiy9M2ffPKaKTPJ15s6lzvlBxyh2p0CVWso3dQrUzNkiFtRdexPlKy6o9Ffao4"/>
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
<img alt="Dini Andriati" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQ55XUppU7PGPNGDNOv5L1Kt4AyEh110-90IJUVEC3Lddwb34-jinpfb92rgoPYii0qhR5KjV0pJXIAlYjC4GzOBF6iuH2x-Kuiu26C-GV_WC0NGWKO_mPD6F23ibnjPUhz_O3Hak0NPREetzRy1s2wHEBsxPZL2AnKJqwsRJ_1dHhsI7u1OVT5TDVjbIVxHUbj9FJohXF4FBRUiP_n0na31AH1YzqxVBnrFqcsEtp6-d1Zf6PA99u8KyAYc22jY4t42XSAAHoSmw"/>
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
<img alt="Rama Maulana Nurrahman" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAGmGkByvwYLKuFFmnHuesVAY5b5Gt2rGmA_jADtyq7ETQFlhjgkjwTJh7PvnSejA0CvD7s1m1YLygDpZvtbSGdBLHT9xRM2DM6l9jPBSrdO1uQP0Oy-oeSI6SvgdTvb9SlTUS2MTLYzXXV2Utp1vJ__mxlP0kUFJRak25WdszFE8OgEsLTwRTCdj4a_JgXe5K6pVWXXT1wbT4UM3K0UohoG1O5Tw4ZPQjaXu2SENMTExEMQz4cxNBWWPwYXeXNq6d09PDyFGbZ2Js"/>
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
<footer class="bg-white dark:bg-surface-dark border-t border-slate-200 dark:border-slate-800 pt-16 pb-8">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
<div>
<div class="flex items-center gap-2 mb-4">
<span class="material-icons-round text-primary text-2xl">home_work</span>
<span class="text-xl font-bold text-slate-900 dark:text-white">LandHub</span>
</div>
<p class="text-slate-600 dark:text-slate-400 text-sm mb-4">
                        Temukan Lahan Impianmu di LandHub.
                    </p>
<div class="flex space-x-4">
<a class="text-slate-400 hover:text-primary transition-colors" href="#"><i class="material-icons-round">facebook</i></a>
<a class="text-slate-400 hover:text-primary transition-colors" href="#"><i class="material-icons-round">smart_display</i></a> 
<a class="text-slate-400 hover:text-primary transition-colors" href="#"><i class="material-icons-round">camera_alt</i></a> 
</div>
</div>
<div>
<h4 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Tentang Kami</h4>
<ul class="space-y-3 text-sm text-slate-600 dark:text-slate-400">
<li>Mahasiswa Informatika</li>
<li>Universitas Sebelas April</li>
<li><a class="hover:text-primary transition-colors" href="#">Privacy Policy</a></li>
</ul>
</div>
<div>
<h4 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Hubungi Kami</h4>
<ul class="space-y-3 text-sm text-slate-600 dark:text-slate-400">
<li class="flex items-center gap-2">
<span class="material-icons-round text-xs">email</span>
                            info@LandHub.com
                        </li>
<li class="flex items-center gap-2">
<span class="material-icons-round text-xs">phone</span>
                            +62 12 3456 78999
                        </li>
<li class="flex items-center gap-2">
<span class="material-icons-round text-xs">location_on</span>
                            Solo, Indonesia
                        </li>
</ul>
</div>
</div>
<div class="border-t border-slate-100 dark:border-slate-800 pt-8 text-center">
<p class="text-sm text-slate-500 dark:text-slate-500">
                    © LandHub 2025 - by greatest team 3 <span class="text-red-500">♥</span>
</p>
</div>
</div>
</footer>

</body></html>
