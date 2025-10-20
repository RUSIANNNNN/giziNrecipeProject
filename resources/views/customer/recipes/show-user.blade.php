@extends('layouts.app')

@section('content')

<div class="py-6">
<div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

    <h2 class="font-semibold text-3xl text-gray-800 leading-tight mb-2">
        {{ $recipe->name }}
    </h2>
    
    <p class="text-gray-600 text-sm mb-4">
        Oleh: 
        @if($recipe->is_official)
            <strong>Pakar Gizi ({{ $recipe->nutritionist }})</strong>
        @else
            <strong>{{ $recipe->user->name ?? 'User' }}</strong>
        @endif
        | Durasi: <strong>{{ $recipe->duration }}</strong>
    </p>

    <!-- Tombol Aksi (Edit/Hapus) -->
    @if(Auth::id() == $recipe->user_id)
        <div class="mb-6 space-x-2">
            {{-- PERBAIKAN 1: Menambahkan kelas CSS agar tombol pasti terlihat --}}
            <a href="{{ route('customer.recipes.edit', $recipe->id) }}" class="inline-block px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg shadow-sm hover:bg-yellow-600 transition-colors">
                Edit Resep
            </a>
            <form action="{{ route('customer.recipes.destroy', $recipe->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus resep ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg shadow-sm hover:bg-red-700 transition-colors">
                    Hapus Resep
                </button>
            </form>
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        {{-- PERBAIKAN 2: Memberi batasan tinggi pada gambar agar tidak terlalu besar --}}
        <img src="{{ $recipe->photo ? asset('storage/' . $recipe->photo) : 'https://placehold.co/800x400/e2e8f0/e2e8f0?text=GiziKu' }}" alt="{{ $recipe->name }}" class="w-full h-80 object-cover">
        
        <div class="p-6 md:p-8">
            <h3 class="font-semibold text-xl text-gray-800 mb-2">Deskripsi</h3>
            <p class="text-gray-700 mb-6">{{ $recipe->description }}</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Bahan & Alat -->
                <div>
                    <h3 class="font-semibold text-xl text-gray-800 mb-3">Alat & Bahan</h3>
                    <ul class="list-disc list-inside space-y-1 text-gray-700">
                        @foreach($recipe->ingredients as $ingredient)
                            <li>{{ $ingredient->item }}</li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- Gizi -->
                <div>
                    <h3 class="font-semibold text-xl text-gray-800 mb-3">Informasi Gizi</h3>
                    <ul class="list-disc list-inside space-y-1 text-gray-700">
                        @forelse($recipe->nutritions as $nutrition)
                            <li><strong>{{ $nutrition->name }}:</strong> {{ $nutrition->value }}</li>
                        @empty
                            <li>Informasi gizi tidak tersedia.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Langkah -->
            <div class="mt-8">
                <h3 class="font-semibold text-xl text-gray-800 mb-3">Langkah Pembuatan</h3>
                <ol class="list-decimal list-inside space-y-2 text-gray-700">
                    @foreach($recipe->steps as $step)
                        <li>{{ $step->instruction }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

</div>


</div>
@endsection