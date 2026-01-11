<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Diri - LandHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter',sans-serif}</style>
</head>
<body class="bg-[#F8F9FE] text-[#1E2B58]">
    <div class="max-w-3xl mx-auto py-12 px-6">
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8">
            <h1 class="text-2xl font-bold mb-4">Edit Data Diri</h1>

            @if(session('success'))
                <div class="mb-4 p-3 rounded-lg bg-green-50 text-green-800">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-800">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-blue-200" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-blue-200" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-blue-200" placeholder="0812xxxx" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat (opsional)</label>
                    <textarea name="address" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-blue-200" rows="3">{{ old('address', Auth::user()->address ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru (kosongkan jika tidak ganti)</label>
                        <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-blue-200" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-blue-200" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profil (opsional)</label>
                    <input type="file" name="avatar" accept="image/*" class="block w-full text-sm text-gray-600" />
                </div>

                <div class="flex items-center justify-between gap-4">
                    <a href="{{ route('landing') }}" class="px-5 py-3 border rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50">Batal</a>
                    <button type="submit" class="px-6 py-3 bg-[#1E2B58] text-white rounded-xl font-bold hover:bg-blue-900">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
