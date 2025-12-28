<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Messages - LandHub</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0f4ff',
                            100: '#e0eaff',
                            200: '#c7d9ff',
                            300: '#9ec0ff',
                            400: '#6d9af8',
                            500: '#427bf0',
                            600: '#2563eb', // Primary Blue
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a', // Deep Blue
                            950: '#172554',
                        },
                        neutral: {
                            50: '#f9fafb',
                            100: '#f3f4f6',
                            200: '#e5e7eb',
                            300: '#d1d5db',
                            400: '#9ca3af',
                            500: '#6b7280',
                            600: '#4b5563',
                            700: '#374151',
                            800: '#1f2937',
                            900: '#111827',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                        'inner-light': 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.02)',
                    }
                },
            },
        };
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #d1d5db;
            border-radius: 20px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #9ca3af;
        }

        /* Bubble Style */
        .message-bubble {
            position: relative;
            width: fit-content; /* AGAR BUBBLE MENYESUAIKAN TEKS */
            max-width: 85%;     /* BATAS MAKSIMAL LEBAR */
            padding: 12px 16px;
            border-radius: 16px;
            font-size: 0.95rem;
            line-height: 1.5;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        .message-bubble.sent {
            background-color: #2563eb;
            color: white;
            border-bottom-right-radius: 4px;
            margin-left: auto; /* Dorong ke kanan */
        }
        .message-bubble.received {
            background-color: white;
            color: #1f2937;
            border-bottom-left-radius: 4px;
            border: 1px solid #e5e7eb;
            margin-right: auto; /* Dorong ke kiri */
        }
    </style>
</head>
<body class="bg-gray-50 text-neutral-800 antialiased h-screen flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 h-[72px] flex items-center justify-between px-6 lg:px-8 z-20 shadow-sm relative shrink-0">
        <div class="flex items-center gap-2">
            <span class="text-brand-900 font-bold text-2xl tracking-tight">LandHub</span>
        </div>
        
        <div>
            <span class="text-brand-900 font-semibold text-sm hover:text-brand-700 cursor-pointer">Messages</span>
        </div>
    </header>

    <main class="flex-1 max-w-[1600px] mx-auto w-full p-4 lg:p-6 h-full overflow-hidden flex flex-col">
        
        <div class="flex gap-6 h-full min-h-0">
            
            <aside class="w-full md:w-[380px] bg-white rounded-2xl shadow-soft border border-gray-100 flex flex-col overflow-hidden shrink-0 {{ $activeConversation ? 'hidden md:flex' : 'flex' }}">
                <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-white sticky top-0 z-10 shrink-0">
                    <h2 class="text-xl font-bold text-neutral-800">Inbox</h2>
                </div>
                
                <div class="px-5 py-3 shrink-0">
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-neutral-400 text-[20px]">search</span>
                        <input class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 transition-all placeholder-neutral-400" placeholder="Search messages..." type="text"/>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto custom-scrollbar">
                    @forelse($conversations as $chat)
                        @php
                            $otherUser = ($chat->sender_id == Auth::id()) ? $chat->receiver : $chat->sender;
                            $isActive = $activeConversation && $activeConversation->id == $chat->id;
                            $lastMessage = $chat->messages->last();
                        @endphp

                        <a href="{{ route('chat.index', ['conversation_id' => $chat->id]) }}" 
                           class="group px-4 py-3 cursor-pointer hover:bg-gray-50 transition-colors block border-l-4 {{ $isActive ? 'bg-brand-50/60 border-brand-600' : 'border-transparent' }}">
                            <div class="flex gap-3">
                                <div class="relative shrink-0">
                                    <img alt="{{ $otherUser->name }}" class="w-12 h-12 rounded-full border-2 border-white shadow-sm object-cover bg-gray-200" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($otherUser->name) }}&background=random"/>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-baseline mb-0.5">
                                        <h3 class="font-semibold text-neutral-900 truncate">{{ $otherUser->name }}</h3>
                                        <span class="text-xs text-neutral-500 font-medium">{{ $chat->updated_at->format('H:i') }}</span>
                                    </div>
                                    <p class="text-sm {{ $isActive ? 'text-neutral-800 font-medium' : 'text-neutral-500' }} truncate font-light">
                                        {{ $lastMessage ? $lastMessage->body : 'Mulai percakapan baru...' }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="p-8 text-center text-neutral-400 text-sm flex flex-col items-center">
                            <span class="material-symbols-outlined text-4xl mb-2 text-gray-300">inbox</span>
                            Belum ada pesan.
                        </div>
                    @endforelse
                </div>
            </aside>

            <section class="flex-1 bg-white rounded-2xl shadow-soft border border-gray-100 flex flex-col overflow-hidden relative {{ !$activeConversation ? 'hidden md:flex' : 'flex' }}">
                
                @if($activeConversation)
                    @php
                        $partner = ($activeConversation->sender_id == Auth::id()) ? $activeConversation->receiver : $activeConversation->sender;
                    @endphp

                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-white z-10 shrink-0">
                        <div class="flex items-center gap-4">
                            <a href="{{ route('chat.index') }}" class="md:hidden text-neutral-400 hover:text-brand-600">
                                <span class="material-symbols-outlined">arrow_back</span>
                            </a>

                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($partner->name) }}&background=random" 
                                     class="w-10 h-10 rounded-full border border-white shadow-sm object-cover bg-gray-200">
                            </div>
                            <div>
                                <h2 class="font-bold text-neutral-900 text-lg leading-tight">{{ $partner->name }}</h2>
                                @if($activeConversation->property)
                                <div class="flex items-center gap-1.5 text-xs text-brand-600 font-medium">
                                    <span class="material-symbols-outlined text-[14px]">home</span>
                                    <span class="truncate max-w-[200px] md:max-w-[300px]">Membahas: {{ Str::limit($activeConversation->property->description, 30) }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button onclick="toggleOfferModal()" class="p-2 text-green-600 bg-green-50 hover:bg-green-100 rounded-full transition-colors mr-1" title="Tawar Harga">
                                <span class="material-symbols-outlined text-[24px]">monetization_on</span>
                            </button>
                            <button onclick="startVideoCall('{{ $activeConversation->id }}')" 
                                    class="p-2 text-gray-400 rounded-full transition-colors" 
                                    title="Mulai Video Call">
                                <span class="material-symbols-outlined text-[24px]">videocam</span>
                            </button>
                            <button class="p-2 text-neutral-400 hover:text-neutral-600 hover:bg-gray-50 rounded-full transition-colors">
                                <span class="material-symbols-outlined text-[22px]">more_vert</span>
                            </button>
                        </div>
                    </div>

                    <div id="messageContainer" class="flex-1 overflow-y-auto p-4 md:p-6 space-y-4 bg-gray-50/50 custom-scrollbar">
                        <div class="flex justify-center my-2">
                            <span class="text-[11px] text-neutral-400 font-medium bg-gray-200/60 px-3 py-1 rounded-full uppercase tracking-wider">Hari Ini</span>
                        </div>

                        @foreach($activeConversation->messages as $msg)
                            <div class="flex flex-col space-y-1 w-full">
                                
                                @if($msg->type == 'offer')
                                    
                                    <div class="message-bubble {{ $msg->user_id == Auth::id() ? 'sent' : 'received' }} !p-0 overflow-hidden min-w-[250px]">
                                        <div class="p-4 bg-white border-b border-gray-100">
                                            <p class="text-xs text-gray-500 font-medium mb-1 uppercase tracking-wider">Penawaran Harga</p>
                                            <h3 class="text-xl font-extrabold text-gray-800">Rp {{ number_format($msg->offer_price, 0, ',', '.') }}</h3>
                                        </div>
                                        
                                        <div class="px-4 py-3 bg-gray-50 flex items-center justify-between">
                                            @if($msg->offer_status == 'pending')
                                                <span class="text-xs font-bold text-orange-500 bg-orange-100 px-2 py-1 rounded">Menunggu Respon</span>
                                                
                                                @if($msg->user_id != Auth::id())
                                                    <div class="flex gap-2">
                                                        <a href="{{ route('chat.handle_offer', ['id' => $msg->id, 'status' => 'rejected']) }}" class="p-1 bg-white border border-gray-200 rounded text-red-500 hover:bg-red-50" title="Tolak">
                                                            <span class="material-symbols-outlined text-[18px]">close</span>
                                                        </a>
                                                        <a href="{{ route('chat.handle_offer', ['id' => $msg->id, 'status' => 'accepted']) }}" class="p-1 bg-green-600 border border-green-600 rounded text-white hover:bg-green-700 shadow-sm" title="Terima">
                                                            <span class="material-symbols-outlined text-[18px]">check</span>
                                                        </a>
                                                    </div>
                                                @endif

                                            @elseif($msg->offer_status == 'accepted')
                                                
                                                @if($msg->user_id == Auth::id())
                                                    
                                                    @php
                                                        // Cari Data Deal ID terkait secara otomatis di View
                                                        // Ini cara cepat agar tidak perlu ubah struktur database pesan
                                                        $deal = App\Models\PropertyDeal::where('user_id', Auth::id())
                                                                ->where('property_id', $activeConversation->property_id)
                                                                ->where('agreed_price', $msg->offer_price) // Pastikan harganya sama
                                                                ->latest()
                                                                ->first();
                                                    @endphp

                                                    @if($deal && $deal->status == 'waiting_payment')
                                                        <div class="mt-2">
                                                            <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center mb-2">
                                                                <p class="text-xs text-green-800 font-bold flex items-center justify-center gap-1">
                                                                    <span class="material-icons text-sm">verified</span>
                                                                    Tawaran Diterima!
                                                                </p>
                                                            </div>
                                                            
                                                            <a href="{{ route('payment.show', ['deal_id' => $deal->id]) }}" class="block w-full bg-primary hover:bg-blue-900 text-white text-center py-2 rounded-lg text-sm font-bold shadow-md transition transform hover:-translate-y-0.5">
                                                                Bayar Sekarang
                                                            </a>
                                                        </div>
                                                    @elseif($deal && $deal->status == 'paid')
                                                        <div class="w-full text-center py-2 bg-blue-100 text-blue-800 text-xs font-bold rounded flex items-center justify-center gap-1 mt-2">
                                                            <span class="material-icons text-sm">check_circle</span> Sudah Dibayar
                                                        </div>
                                                    @else
                                                        <div class="w-full text-center py-1 bg-green-100 text-green-700 text-xs font-bold rounded mt-2">
                                                            Diterima
                                                        </div>
                                                    @endif

                                                @else
                                                    <div class="mt-2">
                                                        <div class="bg-green-100 text-green-800 text-xs font-bold px-3 py-2 rounded flex items-center justify-center gap-1">
                                                            <span class="material-icons text-sm">verified</span>
                                                            Anda Menerima Tawaran Ini
                                                        </div>
                                                        <p class="text-[10px] text-center text-gray-400 mt-1">Menunggu pembayaran pembeli...</p>
                                                    </div>
                                                @endif

                                            @else
                                                <div class="w-full text-center py-1 bg-red-100 text-red-700 text-xs font-bold rounded mt-2">Ditolak</div>
                                            @endif
                                        </div>
                                    </div>

                                @else
                                    <div class="message-bubble {{ $msg->user_id == Auth::id() ? 'sent' : 'received' }}">
                                        {{ $msg->body }}
                                    </div>
                                @endif

                                <div class="text-[10px] text-neutral-400 {{ $msg->user_id == Auth::id() ? 'text-right pr-1' : 'pl-1' }}">
                                    {{ $msg->created_at->format('H:i') }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="p-4 bg-white border-t border-gray-100 shrink-0">
                        <form action="{{ route('chat.send', $activeConversation->id) }}" method="POST" class="flex items-end gap-3 max-w-4xl mx-auto w-full">
                            @csrf
                            <button type="button" class="p-3 text-neutral-400 hover:text-brand-600 hover:bg-gray-50 rounded-full transition-all shrink-0 hidden sm:block">
                                <span class="material-symbols-outlined text-[24px]">add_circle</span>
                            </button>
                            
                            <div class="flex-1 bg-gray-50 border border-gray-200 rounded-[24px] px-4 py-2 focus-within:ring-2 focus-within:ring-brand-500/20 focus-within:border-brand-500 transition-all flex items-center shadow-inner-light">
                                <input type="text" name="body" class="w-full bg-transparent border-none p-2 text-sm focus:ring-0 placeholder-neutral-400 text-neutral-800" placeholder="Tulis pesan..." autocomplete="off" required>
                                
                                <button type="button" class="p-1.5 text-neutral-400 hover:text-neutral-600 rounded-full transition-colors ml-1">
                                    <span class="material-symbols-outlined text-[20px]">sentiment_satisfied</span>
                                </button>
                            </div>

                            <button type="submit" class="p-3 bg-brand-600 hover:bg-brand-700 text-white rounded-full shadow-lg shadow-brand-500/30 transition-all hover:scale-105 active:scale-95 shrink-0 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[20px] ml-0.5">send</span>
                            </button>
                        </form>
                    </div>

                    <script>
                        // Auto scroll ke bawah saat load
                        document.addEventListener("DOMContentLoaded", function() {
                            const container = document.getElementById('messageContainer');
                            if(container) {
                                container.scrollTop = container.scrollHeight;
                            }
                        });
                    </script>

                @else
                    <div class="flex-1 flex flex-col items-center justify-center text-neutral-400 h-full p-6 text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6 shadow-sm">
                            <span class="material-symbols-outlined text-5xl text-brand-300">chat_bubble</span>
                        </div>
                        <h3 class="text-xl font-bold text-neutral-700 mb-2">Pilih Percakapan</h3>
                        <p class="text-sm text-neutral-500 max-w-xs mx-auto">Pilih salah satu kontak di daftar sebelah kiri untuk memulai chatting dengan penjual atau pembeli.</p>
                    </div>
                @endif
            </section>
        </div>
    </main>
    @if($activeConversation) 

        <div id="offerModal" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl w-full max-w-sm p-6 shadow-2xl transform transition-all scale-100">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Ajukan Penawaran</h3>
                <p class="text-sm text-gray-500 mb-4">Masukkan harga yang ingin Anda ajukan ke penjual.</p>
                
                <form action="{{ route('chat.offer', $activeConversation->id) }}" method="POST">
                    @csrf
                    <div class="relative mb-6">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 font-bold">Rp</span>
                        <input type="number" name="offer_price" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 font-bold text-gray-800" placeholder="0" required>
                    </div>
                    
                    <div class="flex gap-3">
                        <button type="button" onclick="toggleOfferModal()" class="flex-1 py-2.5 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition">Batal</button>
                        <button type="submit" class="flex-1 py-2.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition shadow-lg shadow-green-500/30">Kirim Tawaran</button>
                    </div>
                </form>
            </div>
        </div>

    @endif

    <script>
        function toggleOfferModal() {
            document.getElementById('offerModal').classList.toggle('hidden');
        }
        function startVideoCall(conversationId) {
            // 1. Buat Nama Room Unik (Gabungan Nama App + ID Chat)
            // Menggunakan Random String biar tidak ditebak orang lain
            const uniqueId = Math.random().toString(36).substring(7);
            const roomName = `LandHub-Call-${conversationId}-${uniqueId}`;
            const meetingUrl = `https://meet.jit.si/${roomName}`;

            // 2. Buka Jitsi di Tab Baru
            window.open(meetingUrl, '_blank');

            // 3. Otomatis Kirim Link ke Chat (Agar lawan bicara bisa join)
            const inputField = document.querySelector('input[name="body"]');
            const sendButton = document.querySelector('button[type="submit"] span:contains("send")').parentElement; // Mencari tombol kirim

            if (inputField) {
                // Isi pesan otomatis
                inputField.value = `📹 Saya memulai video call. Klik link ini untuk bergabung:\n${meetingUrl}`;
                
                // Submit form secara manual (Kirim Pesan)
                // Kita cari form terdekat dari input
                const form = inputField.closest('form');
                if(form) {
                    form.submit(); 
                }
            }
        }
    </script>

</body>
</html>