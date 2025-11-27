<?php

namespace App\Http\Controllers;

use App\Models\Recipe; // Model Resep
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // data user yang login

class CommentController extends Controller
{
    //   Simpan komentar baru ke database.
    public function store(Request $request, Recipe $recipe)
    {
        // 1. Validasi: Pastikan komentar yang dikirim tidak kosong
        $request->validate([
            'body' => 'required|string|min:3', // Minimal 3 karakter
        ]);

        // 2. Simpan Data:
        // Gunakan "link" (relasi) 'comments()' yang sudah dibuat di Model Recipe.
        // Perintah 'create()' akan otomatis mengisi 'recipe_id'
        // dan kita isi 'user_id' dengan ID user yang sedang login.
        $recipe->comments()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        // 3. Kembali ke halaman resep dengan pesan sukses
        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}