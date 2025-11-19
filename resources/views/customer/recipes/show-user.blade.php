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
<<<<<<< Updated upstream
                
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
=======
                {{-- BATAS ANTARA KONTEN RESEP DAN KOMENTAR --}}
                <hr class="my-8 border-gray-200">

                {{-- BAGIAN FORUM / KOMENTAR --}}
                <div id="forum-section">
                    <h3 class="font-semibold text-2xl text-gray-800 mb-6 flex items-center gap-2">
                        💬 Diskusi & Komentar
                        <span class="text-sm font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                            {{ $recipe->comments->count() }}
                        </span>
                    </h3>

                    {{-- 1. FORM TULIS KOMENTAR (Hanya jika Login) --}}
                    @auth
                        <form action="{{ route('comments.store', $recipe->id) }}" method="POST" class="mb-8">
                            @csrf
                            <div class="flex gap-4">
                                {{-- Avatar User (Opsional, pakai inisial kalau gak ada foto) --}}
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold flex-shrink-0">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                
                                <div class="flex-grow">
                                    <textarea name="body" rows="3" 
                                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 transition" 
                                        placeholder="Tulis pertanyaan, saran, atau review jujur kamu di sini..." required></textarea>
                                    
                                    <button type="submit" class="mt-2 px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors shadow-sm">
                                        Kirim Komentar
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
                            <p class="text-yellow-700">
                                Silakan <a href="{{ route('login') }}" class="font-bold underline hover:text-yellow-800">Login</a> untuk ikut berdiskusi atau bertanya pada resep ini.
                            </p>
                        </div>
                    @endauth

                    {{-- 2. DAFTAR KOMENTAR --}}
                    <div class="space-y-6">
                        @forelse($recipe->comments as $comment)
                            <div class="flex gap-4">
                                {{-- Avatar Komentator --}}
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold flex-shrink-0">
                                    {{ substr($comment->user->name, 0, 1) }}
                                </div>

                                <div class="flex-grow bg-gray-50 p-4 rounded-lg rounded-tl-none border border-gray-100">
                                    <div class="flex justify-between items-start mb-1">
                                        <div>
                                            <span class="font-bold text-gray-900">{{ $comment->user->name }}</span>
                                            
                                            {{-- Badge jika yang komen adalah Pembuat Resep --}}
                                            @if($comment->user_id == $recipe->user_id)
                                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full ml-2 font-semibold">
                                                    Author
                                                </span>
                                            @endif
                                        </div>
                                        <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ $comment->body }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-gray-400 italic">Belum ada diskusi di resep ini. Jadilah yang pertama bertanya!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
>>>>>>> Stashed changes
            </div>
            

        </div>
<<<<<<< Updated upstream
    </div>

</div>


</div>
=======


>>>>>>> Stashed changes
@endsection