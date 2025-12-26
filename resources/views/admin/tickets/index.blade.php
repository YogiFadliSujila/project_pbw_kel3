<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LandHub - Admin Tickets</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F9FE] text-gray-800">

    @if(session('success'))
    <div id="toast-notification" class="fixed top-5 right-5 z-50 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-xl shadow-lg border-l-4 border-green-500 transform transition-all duration-300" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
        </div>
        <div class="ml-3 text-sm font-normal text-gray-800">{{ session('success') }}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 hover:bg-gray-100 inline-flex h-8 w-8" onclick="this.parentElement.remove()">
            <span class="sr-only">Close</span>
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
    @endif

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

                <a href="{{ route('transactions.index') }}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium">Transactions</span>
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#1E2B58] rounded-lg transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                    <span class="font-medium">Advertisement</span>
                </a>

                <a href="{{ route('tickets.index') }}" class="flex items-center px-4 py-3 bg-[#3B82F6] text-white rounded-lg shadow-blue-200 shadow-md transition group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    <span class="font-medium">Tickets</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-50 space-y-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-3 text-gray-500 hover:text-red-600 transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto p-8 relative">
            
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-bold text-[#1E2B58]">Ticket Management</h2>
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
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Tickets</p>
                        <h3 class="text-3xl font-bold text-[#1E2B58] mt-2">{{ $totalTickets }}</h3>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-2xl text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Completed</p>
                        <h3 class="text-3xl font-bold text-green-500 mt-2">{{ $completedTickets }}</h3>
                    </div>
                    <div class="bg-green-50 p-3 rounded-2xl text-green-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">On Progress</p>
                        <h3 class="text-3xl font-bold text-orange-500 mt-2">{{ $onProgressTickets }}</h3>
                    </div>
                    <div class="bg-orange-50 p-3 rounded-2xl text-orange-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Avg. Resolution Time</p>
                        <div class="flex items-baseline gap-1 mt-2">
                            <h3 class="text-3xl font-bold text-purple-600">{{ $avgResTime }}</h3>
                            <span class="text-sm text-gray-400 font-medium">{{ $avgResUnit }}</span>
                        </div>
                    </div>
                    <div class="bg-purple-50 p-3 rounded-2xl text-purple-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="pt-6 pr-6 pl-6 pb-3 flex justify-between items-center gap-4">
                    <h3 class="text-xl font-bold text-[#1E2B58]">Active Tickets</h3>
                </div>

                <div class="pt-3 pr-6 pl-6 pb-3 overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600"> 
                        <thead class="bg-gray-200 text-gray-700 uppercase font-bold text-xs">
                            <tr>
                                <th class="px-6 py-4 whitespace-nowrap rounded-l-xl">Ticket ID</th>
                                <th class="px-6 py-4 whitespace-nowrap">Ticket Transaction</th>
                                <th class="px-6 py-4 whitespace-nowrap">Ticket Property</th>
                                <th class="px-6 py-4 whitespace-nowrap text-center">Service</th>
                                <th class="px-6 py-4 whitespace-nowrap">Buyer</th>
                                <th class="px-6 py-4 whitespace-nowrap">Last Update</th>
                                <th class="px-6 py-4 whitespace-nowrap">Current Status</th>
                                <th class="px-6 py-4 whitespace-nowrap text-center rounded-r-xl">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            
                            @forelse($tickets as $ticket)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-[#1E2B58] whitespace-nowrap">
                                    TC{{ str_pad($ticket->id, 4, '0', STR_PAD_LEFT)}}
                                </td>
                                <td class="px-6 py-4 font-medium text-[#1E2B58] whitespace-nowrap">
                                    {{ $ticket->transaction_code }}
                                </td>
                                <td class="px-6 py-4 font-medium text-[#1E2B58] whitespace-nowrap">
                                    LH{{ str_pad($ticket->property_id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                    
                                    <div>
                                        <div class="font-bold text-gray-800">{{ Str::limit($ticket->property->title, 20) }}</div>
                                        <div class="text-xs text-gray-500">SHM & Balik Nama</div>
                                    </div>
                                    
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $ticket->user->name }}
                                    <div class="text-xs text-gray-400">{{ $ticket->user->email }}</div>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-xs">
                                    @if($ticket->timelines->first())
                                        {{ $ticket->timelines->first()->created_at->format('d M Y, H:i') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $lastStatus = $ticket->timelines->first();
                                        $statusText = $lastStatus ? $lastStatus->title : 'Baru Dibuat';
                                        $statusColor = ($lastStatus && $lastStatus->status_type == 'finished') ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700';
                                    @endphp
                                    <span class="inline-block rounded-full px-3 py-1 text-xs font-bold {{ $statusColor }}">
                                        {{ $statusText }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <button onclick="openUpdateModal({{ json_encode($ticket) }}, {{ json_encode($ticket->timelines->first()) }})" class="px-4 py-2 bg-[#3B82F6] hover:bg-blue-700 text-white text-xs font-bold rounded-lg transition shadow-md flex items-center gap-2 mx-auto">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Update Status
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                    Belum ada tiket layanan aktif.
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $tickets->links() }}
                </div>
            </div>
        </main>
    </div>

    <div id="update-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" onclick="closeUpdateModal()"></div>
        
        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg mx-4 relative z-10 overflow-hidden transform transition-all scale-95 opacity-0" id="update-modal-content">
            
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="text-xl font-bold text-[#1E2B58]">Update Status Tiket</h3>
                <button onclick="closeUpdateModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form id="update-form" method="POST" action="">
                @csrf
                <div class="p-6 space-y-4">
                    
                    <div class="bg-blue-50 p-4 rounded-lg mb-4">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-xs font-bold text-blue-600 uppercase">ID TIKET</span>
                            <span class="text-xs font-bold text-gray-500" id="modal-ticket-id">TM-XXXX</span>
                        </div>
                        <h4 class="font-bold text-gray-800" id="modal-property-title">Nama Properti</h4>
                        <p class="text-sm text-gray-600 mt-1">Status Saat Ini: <span class="font-bold" id="modal-current-status">-</span></p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Update Tahapan Baru</label>
                        <select name="title" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                            <option value="">-- Pilih Tahapan --</option>
                            <option value="Konfirmasi ATR/BPN/Notaris">Konfirmasi ATR/BPN/Notaris</option>
                            <option value="Tiket Dalam Antrean">Tiket Dalam Antrean</option>
                            <option value="Berkas Diproses">Berkas Diproses / Verifikasi</option>
                            <option value="Validasi Lapangan">Validasi Lapangan</option>
                            <option value="Penerbitan Dokumen">Penerbitan Dokumen</option>
                            <option value="Tiket Selesai">Tiket Selesai (Final)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Keterangan Tambahan (Opsional)</label>
                        <textarea name="description" rows="3" class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Contoh: Berkas fisik telah diterima di kantor BPN..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tipe Status</label>
                        <div class="flex gap-4">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="status_type" value="progress" class="form-radio text-blue-600" checked>
                                <span class="ml-2 text-sm text-gray-700">Proses Berjalan (Progress)</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="status_type" value="finished" class="form-radio text-green-600">
                                <span class="ml-2 text-sm text-gray-700">Selesai (Finished)</span>
                            </label>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">*Pilih "Selesai" jika SHM sudah terbit dan tiket ditutup.</p>
                    </div>

                </div>

                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                    <button type="button" onclick="closeUpdateModal()" class="px-5 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-[#3B82F6] text-white font-bold rounded-lg hover:bg-blue-700 transition shadow-lg">Simpan Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openUpdateModal(ticket, lastTimeline) {
            const modal = document.getElementById('update-modal');
            const content = document.getElementById('update-modal-content');
            const form = document.getElementById('update-form');

            // 1. Isi Data ke Modal
            document.getElementById('modal-ticket-id').innerText = ticket.transaction_code;
            document.getElementById('modal-property-title').innerText = ticket.property.title;
            
            if (lastTimeline) {
                document.getElementById('modal-current-status').innerText = lastTimeline.title;
            } else {
                document.getElementById('modal-current-status').innerText = 'Baru Dibuat';
            }

            // 2. Set Action URL Form (Route Laravel)
            // Ganti '999' dengan ID tiket yang diklik
            form.action = "{{ url('/admin/tickets') }}/" + ticket.id + "/update";

            // 3. Tampilkan Modal
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeUpdateModal() {
            const modal = document.getElementById('update-modal');
            const content = document.getElementById('update-modal-content');

            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
</body>
</html>