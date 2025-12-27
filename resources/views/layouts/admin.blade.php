<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'LandHub Admin')</title> <link href="https://fonts.googleapis.com" rel="preconnect"/>
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
                        primary: "#3B82F6", "primary-dark": "#2563EB", "dark-blue": "#1e3a8a", 
                        "background-light": "#F3F5F9", "background-dark": "#0F172A", 
                        "sidebar-light": "#FFFFFF", "sidebar-dark": "#1E293B",
                        "card-light": "#FFFFFF", "card-dark": "#1E293B",
                        "input-border": "#E5E7EB", "input-border-dark": "#374151",
                    },
                    fontFamily: { display: ["Poppins", "sans-serif"], sans: ["Poppins", "sans-serif"] },
                    borderRadius: { DEFAULT: "0.5rem", 'xl': '1rem', '2xl': '1.5rem' },
                },
            },
        };
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark font-sans antialiased text-gray-800 dark:text-gray-200 h-screen overflow-hidden flex transition-colors duration-300">

    <div id="logoutModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0">
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-8 w-full max-w-md transform scale-95 transition-transform duration-300 text-center relative">
            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-8 leading-snug tracking-tight">
                Are you sure you want <br> to log out?
            </h3>
            <div class="flex items-center justify-center gap-6">
                <button onclick="confirmLogout()" class="w-36 py-3 rounded-2xl bg-dark-blue text-white font-bold text-lg hover:bg-blue-900 transition-colors shadow-lg">
                    Logout
                </button>
                <button onclick="closeLogoutModal()" class="w-36 py-3 rounded-2xl bg-white border-2 border-gray-300 text-gray-800 font-bold text-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('logoutModal');
        const modalContent = modal.querySelector('div');

        function openLogoutModal() {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        function closeLogoutModal() {
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => { modal.classList.add('hidden'); }, 300);
        }

        function confirmLogout() {
            document.getElementById('logout-form').submit();
        }

        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeLogoutModal();
        });
    </script>

</body>
</html>