@props(['action', 'placeholder' => 'Cari properti impian...'])

<form action="{{ $action }}" method="GET" class="w-full">
    <div class="relative w-full">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="{{ $placeholder }}"
            class="w-full bg-white border border-gray-200 text-gray-700 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block pl-10 p-3 shadow-sm transition"
        >
        
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <span class="material-icons-outlined text-gray-400">search</span>
        </div>

        <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-2">
            <span class="bg-blue-600 hover:bg-blue-700 text-white rounded-full p-1.5 transition">
                <span class="material-icons-outlined text-sm">arrow_forward</span>
            </span>
        </button>
    </div>
</form>