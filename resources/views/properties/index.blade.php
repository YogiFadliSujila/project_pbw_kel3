<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LandHub - Admin Properties</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { height: 8px; }
        .scrollbar-hide::-webkit-scrollbar-track { background: #f1f1f1; }
        .scrollbar-hide::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 4px; }
        .scrollbar-hide::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }
    </style>
</head>
<body class="bg-[#F8F9FE] text-gray-800">

    @if(session('success'))
    <div id="toast-notification" class="fixed top-5 right-5 z-50 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-xl shadow-lg border-l-4 border-green-500 transform transition-all duration-300 translate-x-full opacity-0" role="alert">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
        </div>
        <div class="ml-3 text-sm font-normal text-gray-800">{{ session('success') }}</div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8" onclick="closeToast()">
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

                <a href="{{ route('properties.index') }}" class="flex items-center px-4 py-3 bg-[#3B82F6] text-white rounded-lg shadow-blue-200 shadow-md transition group">
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

        <main class="flex-1 overflow-y-auto p-8 relative">
            
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-3xl font-bold text-[#1E2B58]">Properties</h2>
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
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Properties</p>
                        <h3 class="text-3xl font-bold text-[#1E2B58] mt-2">{{ \App\Models\Property::count() }}</h3>
                        <div class="mt-4 text-sm text-gray-400">Available listings</div>
                    </div>
                    <div class="bg-orange-50 p-3 rounded-2xl text-orange-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Portfolio Value</p>
                        <h3 class="text-3xl font-bold text-[#1E2B58] mt-2">@php
                            $totalPrice = \App\Models\Property::sum('price');
                            if ($totalPrice >= 1000000000000) {
                                $formattedPrice = number_format($totalPrice / 1000000000000, 1, ',', '.') . ' T';
                            } elseif ($totalPrice >= 1000000000) {
                                $formattedPrice = number_format($totalPrice / 1000000000, 1, ',', '.') . ' B';
                            } elseif ($totalPrice >= 1000000) {
                                $formattedPrice = number_format($totalPrice / 1000000, 1, ',', '.') . ' M';
                            } else {
                                $formattedPrice = number_format($totalPrice, 0, ',', '.');
                            }
                        @endphp IDR {{$formattedPrice}}</h3>
                        <div class="mt-4 text-sm text-gray-400">Total portfolio valuation</div>
                    </div>
                    <div class="bg-green-50 p-3 rounded-2xl text-green-400">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Appreciation Rate</p>
                        <h3 class="text-3xl font-bold text-green-500 mt-2">7.5%</h3>
                        <div class="mt-4 text-sm text-gray-400">Average appreciation rate</div>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-2xl text-blue-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">This Month</p>
                        <h3 class="text-3xl font-bold text-[#1E2B58] mt-2">{{ \App\Models\Property::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count() }}</h3>
                        <div class="mt-4 text-sm text-gray-400">New listings added</div>
                    </div>
                    <div class="bg-orange-50 p-3 rounded-2xl text-orange-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                
                <div class="pt-6 pr-6 pl-6 pb-3 flex flex-col md:flex-row justify-between items-center gap-4">
                    <h3 class="text-xl font-bold text-[#1E2B58]">Property Portfolio</h3>
                    <a href="{{ route('properties.create') }}" class="px-4 py-2 bg-[#3B82F6] text-white text-sm font-medium rounded-lg hover:bg-blue-600 transition flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Add New Property
                    </a>
                </div>

                <form action="{{ route('properties.index') }}" method="GET" class="pt-3 pr-6 pl-6 pb-3 flex flex-col md:flex-row gap-4 justify-between items-center">
    
                    <div class="relative w-full md:w-100">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Search ID, Location, Description..." 
                            class="w-full bg-gray-100 pl-10 pr-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </div>

                    <div class="w-full md:w-48">
                        <select name="status" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-500 focus:outline-none bg-gray-100">
                            <option value="All Status" {{ request('status') == 'All Status' ? 'selected' : '' }}>All Status</option>
                            
                            <option value="Accepted" {{ request('status') == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="Sold" {{ request('status') == 'Sold' ? 'selected' : '' }}>Sold</option>
                        </select>
                    </div>
                </form>

                <div class="pt-3 pr-6 pl-6 pb-3 overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600 min-w-[1500px]"> 
                        <thead class="bg-gray-200 text-gray-700 uppercase font-bold text-xs">
                            <tr>
                                <th class="px-6 py-4 whitespace-nowrap rounded-l-xl">Id Property</th>
                                <th class="px-6 py-4 whitespace-nowrap">Email</th>
                                <th class="px-6 py-4 whitespace-nowrap">Images</th>
                                <th class="px-6 py-4 whitespace-nowrap min-w-[200px]">Property Description</th>
                                <th class="px-6 py-4 whitespace-nowrap min-w-[200px]">Property Specification</th>
                                <th class="px-6 py-4 whitespace-nowrap">Category</th>
                                <th class="px-6 py-4 whitespace-nowrap">Area</th>
                                <th class="px-6 py-4 whitespace-nowrap">Location</th>
                                <th class="px-6 py-4 whitespace-nowrap">Price</th>
                                <th class="px-6 py-4 whitespace-nowrap">Ads Category</th>
                                <th class="px-6 py-4 whitespace-nowrap">Document</th>
                                <th class="px-6 py-4 whitespace-nowrap">Status</th>
                                <th class="px-6 py-4 whitespace-nowrap text-center rounded-r-xl">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            
                            @forelse($properties as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    LH{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-blue-600 underline cursor-pointer">
                                    {{ $item->user->email ?? 'no-email' }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex gap-1 w-24">
                                        <div class="w-8 h-8 rounded bg-gray-200 overflow-hidden border border-gray-300 shrink-0">
                                            <img src="{{ $item->image ? asset($item->image) : 'https://via.placeholder.com/100' }}" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 max-w-xs truncate" title="{{ $item->description }}">
                                    {{ $item->description }}
                                </td>
                                
                                <td class="px-6 py-4 max-w-xs truncate" title="{{ $item->specifications }}">
                                    {{ $item->specifications }}
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-block border border-gray-300 rounded-md px-3 py-1 text-xs font-bold text-gray-700 bg-white">
                                        {{ $item->category }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->area }} m²</td>

                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->location }}</td>

                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                    IDR {{ number_format($item->price, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $adsColor = match($item->ads_category) {
                                            'Gold' => 'bg-yellow-500 text-white',
                                            'Basic' => 'bg-blue-500 text-white',
                                            'Silver' => 'bg-gray-500 text-white',
                                            default => 'bg-blue-100 text-blue-600'
                                        };
                                    @endphp
                                    <span class="inline-block rounded-md px-3 py-1 text-xs font-bold {{ $adsColor }}">
                                        {{ $item->ads_category }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($item->document)
                                        <a href="{{ asset($item->document) }}" target="_blank" class="flex items-center gap-2 border border-gray-300 px-2 py-1 rounded bg-white hover:bg-gray-50 w-max transition group">
                                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"></path></svg>
                                            <span class="text-xs text-gray-600 group-hover:text-blue-600">Lihat Dokumen</span>
                                        </a>
                                    @else
                                        <span class="text-xs text-gray-400 italic">Tidak ada file</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColor = match($item->status) {
                                            'Accepted' => 'bg-green-500 text-white',
                                            'Sold'      => 'bg-blue-500 text-white',
                                            'Rejected' => 'bg-red-500 text-white',
                                            'Pending' => 'bg-orange-400 text-white',
                                            default => 'bg-green-500 text-white'
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                                        {{ $item->status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <button onclick="openShowModal({{ json_encode($item) }})" class="text-gray-500 hover:text-blue-600 transition" title="Lihat Detail">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </button>
                                        @if($item->status == 'Sold')
                                            <button type="button" class="text-gray-300 cursor-not-allowed" title="Item terjual tidak dapat diedit" disabled>
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </button>
                                        @else
                                            <a href="{{ route('properties.edit', $item->id) }}" class="text-gray-500 hover:text-yellow-500 transition" title="Edit Property">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                        @endif
                                        <button type="button" onclick="openDeleteModal('{{ route('properties.destroy', $item->id) }}')" class="text-gray-500 hover:text-red-600 transition" title="Hapus Property">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13" class="px-6 py-10 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <p>Data tidak ditemukan / Belum ada properti.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div class="mt-4 px-6">
                    {{ $properties->withQueryString()->links() }}
                </div>
            </div>
        </main>
    </div>

    <div id="show-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" onclick="closeShowModal()"></div>
        
        <div class="bg-white rounded-xl shadow-xl w-full max-w-4xl mx-4 relative z-10 overflow-hidden transform transition-all scale-95 opacity-0 flex flex-col max-h-[90vh]" id="show-modal-content">
            
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="text-xl font-bold text-blue-900">Detail Properti</h3>
            </div>

            <div class="p-6 overflow-y-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <div>
                        <div class="rounded-lg overflow-hidden border border-gray-200 shadow-sm mb-4">
                            <img id="show-image" src="" alt="Property Image" class="w-full h-64 object-cover">
                        </div>
                        
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="bg-white p-2 rounded-full shadow-sm">
                                    <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a2 2 0 00-2 2v8a2 2 0 002 2h6a2 2 0 002-2V6.414A2 2 0 0016.414 5L14 2.586A2 2 0 0012.586 2H9z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-700">Dokumen Kepemilikan</p>
                                    <p class="text-xs text-gray-500">Legal Document</p>
                                </div>
                            </div>
                            <a id="show-document-link" href="#" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-bold">Download</a>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <span id="show-category" class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold mb-2">Category</span>
                            <span id="show-status" class="inline-block px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold mb-2 ml-2">Status</span>
                            
                            <h2 id="show-location" class="text-2xl font-bold text-gray-900">Location Name</h2>
                            <p id="show-price" class="text-xl font-bold text-green-600 mt-1">Rp 0</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500">Luas Area</p>
                                <p id="show-area" class="font-bold text-gray-800">0 m2</p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-500">Tipe Iklan</p>
                                <p id="show-ads-category" class="font-bold text-gray-800">Basic</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm font-bold text-gray-700 mb-1">Deskripsi</p>
                            <p id="show-description" class="text-sm text-gray-600 leading-relaxed bg-gray-50 p-3 rounded-lg h-24 overflow-y-auto">Desc...</p>
                        </div>

                        <div>
                            <p class="text-sm font-bold text-gray-700 mb-1">Spesifikasi</p>
                            <p id="show-specifications" class="text-sm text-gray-600 bg-gray-50 p-3 rounded-lg">Specs...</p>
                        </div>
                        
                        <div>
                            <p class="text-xs text-gray-400 mt-2">Pemilik: <span id="show-email" class="text-gray-600">email@example.com</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                <button onclick="closeShowModal()" class="px-6 py-2 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition">Tutup</button>
            </div>
        </div>
    </div>


    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" onclick="closeDeleteModal()"></div>
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative z-10 transform transition-all scale-95 opacity-0" id="delete-modal-content">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                    <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Properti Ini?</h3>
                <p class="text-sm text-gray-500 mb-6">
                    Apakah Anda yakin ingin menghapus properti ini? <br>
                    Tindakan ini tidak dapat dibatalkan dan file terkait akan dihapus permanen.
                </p>

                <div class="flex justify-center gap-3">
                    <button type="button" onclick="closeDeleteModal()" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                        Batal
                    </button>
                    <button type="button" id="confirm-delete-btn" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition shadow-md">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
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
    
    <form id="delete-form" method="POST" class="hidden">
        @csrf
        @method('DELETE')
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