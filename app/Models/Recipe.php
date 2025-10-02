<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
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
}
