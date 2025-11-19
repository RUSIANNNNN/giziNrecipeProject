@extends('layouts.app')

@section('content')

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        {{-- Header dan Tombol Tambah --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Daftar Resep GiziKu
            </h2>
            <a href="{{ route('customer.recipes.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors shadow-sm">
                + Tambah Resep Kamu
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($recipes as $recipe)
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300 flex flex-col h-full relative group">
                    
                    {{-- BAGIAN FOTO (RELATIVE AGAR TOMBOL BISA MELAYANG) --}}
                    <div class="relative h-48 w-full bg-gray-200 overflow-hidden">
                        
                        {{-- Link Pembungkus Foto --}}
                        <a href="{{ route('customer.recipes.show', $recipe->id) }}" class="block w-full h-full">
                            <img src="{{ $recipe->photo ? asset('storage/' . $recipe->photo) : 'https://placehold.co/600x400/e2e8f0/e2e8f0?text=GiziKu' }}" 
                                 alt="{{ $recipe->name }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </a>

                        {{-- === TOMBOL WISHLIST (FLOATING DI ATAS FOTO) === --}}
                        @auth
                            <div class="absolute top-2 right-2 z-10">
                                <form action="{{ route('recipes.bookmark', $recipe->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-2 rounded-full shadow-md transition-colors duration-200 focus:outline-none
                                        {{ $recipe->isBookmarkedBy(auth()->user()) 
                                            ? 'bg-white text-red-500 hover:bg-red-50' 
                                            : 'bg-white/80 text-gray-400 hover:text-red-500 hover:bg-white' 
                                        }}"
                                        title="{{ $recipe->isBookmarkedBy(auth()->user()) ? 'Hapus dari Favorit' : 'Simpan ke Favorit' }}">
                                        
                                        @if($recipe->isBookmarkedBy(auth()->user()))
                                            {{-- Icon Full (Merah) --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                                <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                            </svg>
                                        @else
                                            {{-- Icon Outline (Abu/Transparan) --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                            </div>
                        @endauth
                        {{-- ===================================== --}}
                    </div>
                    
                    {{-- BAGIAN KONTEN TEKS --}}
                    <div class="p-6 flex flex-col flex-grow">
                        @if($recipe->is_official)
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded-full mb-2 w-max">
                                Resep Official
                            </span>
                        @endif
                        
                        {{-- Judul Resep --}}
                        <a href="{{ route('customer.recipes.show', $recipe->id) }}" class="hover:text-green-600 transition-colors">
                            <h3 class="font-semibold text-lg text-gray-900 flex-grow">
                                {{ $recipe->name }}
                            </h3>
                        </a>
                        
                        <p class="text-gray-600 text-sm mt-2">
                            Durasi: {{ $recipe->duration }}
                        </p>
                        
                        <p class="text-gray-500 text-sm mt-1">
                            Oleh: 
                            @if($recipe->is_official)
                                <strong>Pakar Gizi ({{ $recipe->nutritionist }})</strong>
                            @else
                                <strong>{{ $recipe->user->name ?? 'User' }}</strong>
                            @endif
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-gray-700 col-span-3 text-center py-10">Belum ada resep yang diposting.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $recipes->links() }}
        </div>
    </div>
</div>
@endsection