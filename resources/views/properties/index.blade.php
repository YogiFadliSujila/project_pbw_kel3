<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LandHub - Admin Properties</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { height: 8px; }
        .scrollbar-hide::-webkit-scrollbar-track { background: #f1f1f1; }
        .scrollbar-hide::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 4px; }
        .scrollbar-hide::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col z-10">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-blue-900">LandHub</h1>
            </div>

            <nav class="flex-1 px-4 space-y-1">
                <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Dashboard
                </a>
                <a href="{{ route('properties.index') }}" class="flex items-center px-4 py-3 bg-blue-600 text-white rounded-lg shadow-md transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Properties
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Users
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-blue-600 rounded-lg transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                    Advertisement
                </a>
            </nav>
            <div class="p-4 border-t border-gray-200">
                <a href="#" class="flex items-center text-gray-600 hover:text-red-600">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </a>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto p-8 relative">
            
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Properties</h2>
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-gray-900">Budi</p>
                        <p class="text-xs text-gray-500">Admin</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                         <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Properties</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ \App\Models\Property::count() }}</h3>
                        <p class="text-gray-400 text-xs mt-1">Available for sale</p>
                    </div>
                    <div class="self-end mt-4 bg-yellow-100 p-2 rounded-lg text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Portfolio Value</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">IDR 106 T</h3>
                        <p class="text-gray-400 text-xs mt-1">Total portfolio valuation</p>
                    </div>
                    <div class="self-end mt-4 bg-green-100 p-2 rounded-lg text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                </div>
                 <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Appreciation Rate</p>
                        <h3 class="text-3xl font-bold text-green-500 mt-2">7.5%</h3>
                        <p class="text-gray-400 text-xs mt-1">Average appreciation rate</p>
                    </div>
                    <div class="self-end mt-4 bg-blue-100 p-2 rounded-lg text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    </div>
                </div>
                 <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">This Month</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">23</h3>
                        <p class="text-gray-400 text-xs mt-1">New listings added</p>
                    </div>
                    <div class="self-end mt-4 bg-red-100 p-2 rounded-lg text-red-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                
                <form action="{{ route('properties.index') }}" method="GET" class="p-6 border-b border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
                    <h3 class="text-xl font-bold text-gray-800">Property Portfolio</h3>
                    
                    <div class="flex gap-3 w-full md:w-auto">
                        <div class="relative w-full md:w-64">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        </div>

                        <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-4 py-2 text-sm text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option {{ request('status') == 'All Status' ? 'selected' : '' }}>All Status</option>
                            <option {{ request('status') == 'Available' ? 'selected' : '' }}>Available</option>
                            <option {{ request('status') == 'Sold' ? 'selected' : '' }}>Sold</option>
                        </select>

                        <a href="{{ route('properties.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition whitespace-nowrap">
                            <span>Add New Property</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </a>
                    </div>
                </form>

                <div class="overflow-x-auto scrollbar-hide">
                    <table class="w-full text-left text-sm text-gray-600 min-w-[1500px]"> 
                        <thead class="bg-gray-50 text-gray-700 uppercase font-bold text-xs">
                            <tr>
                                <th class="px-6 py-4 whitespace-nowrap">Id Property</th>
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
                                <th class="px-6 py-4 whitespace-nowrap text-center">Action</th>
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
                                            'Rejected' => 'bg-red-500 text-white',
                                            'Pending' => 'bg-orange-400 text-white',
                                            default => 'bg-green-100 text-green-700'
                                        };
                                    @endphp
                                    <span class="inline-block rounded-full px-3 py-1 text-xs font-bold {{ $statusColor }}">
                                        {{ $item->status == 'Available' ? 'Accepted' : $item->status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('properties.edit', $item->id) }}" class="text-gray-500 hover:text-green-600 transition" title="Edit Status">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
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

                <div class="p-4 border-t border-gray-200 flex justify-between items-center text-sm text-gray-500">
                    <p>Total data: {{ $properties->count() }} properties</p>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50 disabled:opacity-50" disabled>Previous</button>
                        <button class="px-3 py-1 border border-gray-300 rounded hover:bg-gray-50 disabled:opacity-50" disabled>Next</button>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>