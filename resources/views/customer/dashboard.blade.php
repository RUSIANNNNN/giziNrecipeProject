{{-- resources/views/customer/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-6">Selamat Datang, {{ auth()->user()->name }}!</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Contoh statistik sederhana, bisa ditambahkan --}}
        <div class="p-4 bg-blue-100 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Jumlah Resep</h2>
            <p class="text-2xl">{{ $recipeCount }}</p>
            <br>
            {{-- Tombol menuju daftar semua resep --}}
            <a href="{{ route('customer.recipes.index') }}" 
                class="inline-block px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded hover:bg-green-700 transition-colors">
                Lihat Semua Resep
            </a>
        </div>
        <div class="p-4 bg-green-100 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Resep Favorit Anda</h2>
<<<<<<< Updated upstream
            <p class="text-2xl">-</p>
=======
            <p class="text-2xl">{{ $bookmarksCount }}</p>
            <br>
            <a href="{{ route('bookmarks.index') }}" class="inline-block px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded hover:bg-green-700 transition-colors">
                Lihat Favorit
            </a>
>>>>>>> Stashed changes
        </div>
        {{-- TOMBOL BARU: Klik untuk melihat daftar favorit --}}
        
     
        <div class="p-4 bg-yellow-100 rounded shadow">
            <h2 class="text-lg font-semibold mb-2">Rating Rata-rata</h2>
            <p class="text-2xl">-</p>
        </div>
    </div>


</div>
@endsection
