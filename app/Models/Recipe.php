<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',      // 
        'is_official', //
        'name',
        'nutritionist',
        'duration',
        'description',
        'photo',
    ];

    // Relasi ke ingredients
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    // Relasi ke steps
    public function steps()
    {
        return $this->hasMany(Step::class)->orderBy('order');
    }

    // Relasi ke nutrisi
    public function nutritions()
    {
        return $this->hasMany(Nutrition::class);
    }

    // **Relasi ke ratings**
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // App\Models\Recipe.php
    public function averageRating(): float
    {
        return (float) ($this->ratings()->avg('rating') ?? 0);
    }

    // Tiap resep dimiliki satu user, relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
<<<<<<< Updated upstream
=======
    
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    // Fitur Tambahan: Cek apakah resep ini dibookmark oleh user yang sedang login
    public function isBookmarkedBy($user)
    {
        if (!$user) return false;
        return $this->bookmarks->where('user_id', $user->id)->count() > 0;
    }

    // Relasi: Satu resep punya banyak komentar
    public function comments()
    {
        // latest() agar komentar terbaru muncul paling atas
        return $this->hasMany(Comment::class)->latest(); 
    }
    
>>>>>>> Stashed changes
}
