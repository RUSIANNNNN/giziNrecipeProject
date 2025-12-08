{{-- resources/views/customer/dashboard.blade.php --}}
@extends('layouts.customer')

@section('title', 'Beranda | NutriRecipe')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        {{-- HERO SECTION --}}
        <section class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
            <div class="space-y-4">
                <p class="text-xs font-semibold tracking-wide text-emerald-700 uppercase">
                    Selamat datang, {{ auth()->user()->name }} 👋
                </p>
                <h1 class="text-3xl sm:text-4xl font-semibold tracking-tight text-slate-900">
                    Mulai hari dengan resep yang <span class="text-emerald-600">sehat</span> dan <span
                        class="text-emerald-600">bergizi</span>.
                </h1>
                <p class="text-sm sm:text-base text-slate-600">
                    NutriRecipe membantu kamu menemukan, menyimpan, dan mempraktikkan resep pilihan
                    dari pakar gizi maupun komunitas. Tidak hanya enak, tapi juga seimbang untuk tubuhmu.
                </p>

                <div class="flex flex-wrap gap-3 pt-2">
                    <a href="{{ route('customer.recipes.index') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-emerald-700">
                        Jelajahi Semua Resep
                    </a>
                    <a href="{{ route('bookmarks.index') }}"
                        class="inline-flex items-center gap-2 rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
                        Lihat Resep Favorit
                    </a>
                </div>
            </div>

            {{-- Ilustrasi / highlight area --}}
            <div class="relative">
                <div
                    class="rounded-3xl bg-gradient-to-br from-emerald-500 via-emerald-400 to-emerald-600 text-white p-6 sm:p-7 shadow-lg">
                    <p class="text-xs font-semibold uppercase tracking-wide opacity-80">
                        Ringkasan singkat
                    </p>
                    <p class="mt-2 text-lg font-semibold">
                        Satu tempat untuk resep sehat kamu.
                    </p>
                    <p class="mt-2 text-sm text-emerald-50">
                        Pantau jumlah resep, simpan favorit, dan jadikan makan sehat sebagai kebiasaan, bukan sekadar
                        wacana.
                    </p>

                    <div class="mt-4 grid grid-cols-3 gap-3 text-center text-xs">
                        <div class="bg-emerald-700/20 rounded-xl py-3 px-2">
                            <p class="text-[11px] uppercase tracking-wide opacity-75">Total Resep</p>
                            <p class="mt-1 text-lg font-semibold">{{ $recipeCount }}</p>
                        </div>
                        <div class="bg-emerald-700/20 rounded-xl py-3 px-2">
                            <p class="text-[11px] uppercase tracking-wide opacity-75">Favorit Kamu</p>
                            <p class="mt-1 text-lg font-semibold">{{ $bookmarksCount }}</p>
                        </div>
                        <div class="bg-emerald-700/20 rounded-xl py-3 px-2">
                            <p class="text-[11px] uppercase tracking-wide opacity-75">Rating Kamu</p>
                            <p class="mt-1 text-lg font-semibold">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- STAT CARDS --}}
        <section class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-4">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Resep tersedia</p>
                <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $recipeCount }}</p>
                <p class="mt-1 text-xs text-slate-500">
                    Jelajahi resep resmi dan buatan pengguna lain yang sudah dikurasi.
                </p>
            </div>

            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-4">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Resep favorit</p>
                <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $bookmarksCount }}</p>
                <p class="mt-1 text-xs text-slate-500">
                    Kumpulkan resep pilihanmu untuk diulang kapan saja tanpa harus mencari ulang.
                </p>
            </div>

            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-4">
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Mulai dari yang sederhana</p>
                <p class="mt-2 text-2xl font-semibold text-slate-900">Step by step</p>
                <p class="mt-1 text-xs text-slate-500">
                    Ikuti langkah yang jelas dan komposisi gizi yang transparan di setiap resep.
                </p>
            </div>
        </section>

        {{-- QUICK ACTIONS --}}
        <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-4 flex flex-col gap-2">
                <h2 class="text-sm font-semibold text-slate-900">Mulai dengan resep official</h2>
                <p class="text-xs text-slate-500">
                    Jelajahi resep yang disusun oleh pakar gizi, lengkap dengan komposisi nutrisi.
                </p>
                <a href="{{ route('customer.recipes.index') }}"
                    class="mt-auto inline-flex text-xs font-medium text-emerald-700 hover:text-emerald-900">
                    Lihat resep official →
                </a>
            </div>

            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-4 flex flex-col gap-2">
                <h2 class="text-sm font-semibold text-slate-900">Lanjutkan dari favoritmu</h2>
                <p class="text-xs text-slate-500">
                    Buka kembali resep yang pernah kamu simpan dan jadikan menu andalan harian.
                </p>
                <a href="{{ route('bookmarks.index') }}"
                    class="mt-auto inline-flex text-xs font-medium text-emerald-700 hover:text-emerald-900">
                    Buka daftar favorit →
                </a>
            </div>

            <a href="{{ route('customer.recipes.create-rules') }}"
                class="inline-flex items-center gap-2 rounded-sm bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Buat Resep Baru</span>
            </a>

            <div class="bg-white border border-slate-100 rounded-2xl shadow-sm p-4 flex flex-col gap-2">
                <h2 class="text-sm font-semibold text-slate-900">Perbarui profilmu</h2>
                <p class="text-xs text-slate-500">
                    Lengkapi data diri untuk pengalaman rekomendasi resep yang lebih relevan.
                </p>
                {{-- <a href="{{ route('profile.dashboard') }}"
                   class="mt-auto inline-flex text-xs font-medium text-emerald-700 hover:text-emerald-900">
                    Atur profil →
                </a> --}}
            </div>
        </section>

        {{-- EDU SECTION / TIPS --}}
        <section class="bg-white border border-slate-100 rounded-2xl shadow-sm p-5 md:p-6">
            <h2 class="text-sm font-semibold text-slate-900 mb-2">
                Tips singkat: bagaimana memilih resep yang tepat?
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs text-slate-600">
                <div class="space-y-1">
                    <p class="font-semibold text-slate-800">1. Sesuaikan dengan waktumu</p>
                    <p>
                        Pilih durasi yang realistis dengan jadwalmu. NutriRecipe memudahkan kamu melihat estimasi waktu tiap
                        resep.
                    </p>
                </div>
                <div class="space-y-1">
                    <p class="font-semibold text-slate-800">2. Perhatikan komposisi gizi</p>
                    <p>
                        Lihat kandungan kalori, protein, dan karbohidrat untuk menyeimbangkan kebutuhan harianmu.
                    </p>
                </div>
                <div class="space-y-1">
                    <p class="font-semibold text-slate-800">3. Simpan resep yang cocok</p>
                    <p>
                        Jika sudah cocok, simpan ke favorit. Dengan begitu, kamu punya “koleksi sehat” pribadi.
                    </p>
                </div>
            </div>
        </section>

    </div>
@endsection
