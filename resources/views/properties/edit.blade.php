<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Status Property - LandHub Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-blue-900">LandHub</h1>
            </div>
            <nav class="flex-1 px-4 space-y-1">
                <a href="{{ route('properties.index') }}" class="flex items-center px-4 py-3 bg-blue-600 text-white rounded-lg shadow-md transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Back to Properties
                </a>
            </nav>
        </aside>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-4xl mx-auto">
                
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Edit Status Property</h2>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Property Name</label>
                            <p class="text-lg font-bold text-gray-900">{{ $property->category }} - {{ $property->area }} m²</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Owner Email</label>
                            <p class="text-lg font-bold text-gray-900">{{ $property->user->email ?? 'No Email' }}</p>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-500 mb-1">Location</label>
                            <p class="text-gray-900">{{ $property->location }}</p>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-500 mb-2">Photo</label>
                            <div class="w-full h-48 bg-gray-100 rounded-lg overflow-hidden border border-gray-300">
                                <img src="{{ $property->image ? asset($property->image) : 'https://via.placeholder.com/600x400' }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-100 my-6">

                    <form action="{{ route('properties.update', $property->id) }}" method="POST">
                        @csrf
                        @method('PUT') <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Change Status</label>
                            <div class="relative">
                                <select name="status" class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md border">
                                    <option value="Pending" {{ $property->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Available" {{ $property->status == 'Available' ? 'selected' : '' }}>Accepted (Setujui)</option>
                                    <option value="Rejected" {{ $property->status == 'Rejected' ? 'selected' : '' }}>Rejected (Tolak)</option>
                                </select>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Mengubah status menjadi "Accepted" akan menayangkan iklan ini ke publik.</p>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition shadow-md">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('properties.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </main>
    </div>

</body>
</html>