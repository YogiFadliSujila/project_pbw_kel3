<div id="filterModal" class="fixed inset-0 z-[999] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" onclick="toggleFilterModal()"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-gray-100">
                
                <form action="{{ route('listing.index') }}" method="GET">
                    <input type="hidden" name="search" value="{{ request('search') }}">

                    <header class="flex items-center justify-between px-8 py-6 border-b border-gray-100 bg-white">
                        <div>
                            <h1 class="text-xl font-bold text-gray-900 tracking-tight">Filter Pencarian</h1>
                            <p class="text-sm text-gray-500 mt-1">Sesuaikan properti dengan kebutuhanmu</p>
                        </div>
                        <button type="button" onclick="toggleFilterModal()" class="text-gray-400 hover:text-gray-600 p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <span class="material-icons text-2xl">close</span>
                        </button>
                    </header>

                    <div class="p-8 space-y-8 bg-white">
                        <section>
                            <label class="block text-sm font-bold text-gray-800 mb-4 uppercase tracking-wider">Tipe Properti</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @foreach(['Lahan', 'Rumah', 'Ruko', 'Gedung'] as $type)
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="category" value="{{ $type }}" class="peer sr-only" {{ request('category') == $type ? 'checked' : '' }}>
                                    <div class="flex items-center justify-center px-4 py-3 text-sm font-medium rounded-xl border border-gray-200 bg-white shadow-md text-gray-600 hover:bg-blue-50 hover:border-blue-200 transition-all peer-checked:border-2 peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-checked:text-blue-700">
                                        {{ $type }}
                                    </div>
                                    <div class="absolute top-0 right-0 -mt-1 -mr-1 hidden peer-checked:block">
                                        <span class="flex h-4 w-4 items-center justify-center rounded-full bg-blue-600 ring-2 ring-white">
                                            <svg class="h-2.5 w-2.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                        </span>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </section>

                        <section>
                            <label class="block text-sm font-bold text-gray-800 mb-4 uppercase tracking-wider">Harga (IDR)</label>
                            <div class="flex items-center gap-4">
                                <div class="relative w-full">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 text-sm font-medium">Rp</span>
                                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="block w-full pl-10 pr-4 py-3 bg-gray-200 border-transparent focus:bg-white focus:border-blue-500 focus:ring-blue-500 rounded-xl text-sm transition-colors">
                                </div>
                                <span class="text-gray-400 font-medium">—</span>
                                <div class="relative w-full">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 text-sm font-medium">Rp</span>
                                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="block w-full pl-10 pr-4 py-3 bg-gray-200 border-transparent focus:bg-white focus:border-blue-500 focus:ring-blue-500 rounded-xl text-sm transition-colors">
                                </div>
                            </div>
                        </section>

                        <section>
                            <label class="block text-sm font-bold text-gray-800 mb-4 uppercase tracking-wider">Luas Tanah</label>
                            <div class="flex items-center gap-4">
                                <div class="relative w-full">
                                    <input type="number" name="min_area" value="{{ request('min_area') }}" placeholder="Min" class="block w-full pl-4 pr-10 py-3 bg-gray-200 border-transparent focus:bg-white focus:border-blue-500 focus:ring-blue-500 rounded-xl text-sm transition-colors">
                                    <span class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-500 text-sm font-medium">m²</span>
                                </div>
                                <span class="text-gray-400 font-medium">—</span>
                                <div class="relative w-full">
                                    <input type="number" name="max_area" value="{{ request('max_area') }}" placeholder="Max" class="block w-full pl-4 pr-10 py-3 bg-gray-200 border-transparent focus:bg-white focus:border-blue-500 focus:ring-blue-500 rounded-xl text-sm transition-colors">
                                    <span class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-500 text-sm font-medium">m²</span>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex items-center justify-between gap-4">
                        <a href="{{ route('listing.index') }}" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-600 hover:text-gray-900 hover:bg-gray-200 transition-colors">
                            Reset Filter
                        </a>
                        <button type="submit" class="px-8 py-3 bg-blue-700 hover:bg-blue-800 text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5">
                            Lihat Hasil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFilterModal() {
        const modal = document.getElementById('filterModal');
        modal.classList.toggle('hidden');
    }
</script>