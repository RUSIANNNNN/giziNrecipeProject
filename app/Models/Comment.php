<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Kolom yang boleh diisi
    protected $fillable = ['user_id', 'recipe_id', 'body'];

    // Relasi: Komentar milik User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Komentar milik Resep
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}