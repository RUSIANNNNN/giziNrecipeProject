<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'user_id', 
        'recipe_id', 
        'rating'
    ];

    // Relasi: Rating ini dimiliki oleh SATU User.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Rating ini dimiliki oleh SATU Recipe.
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}