<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menambahkan batasan unik pada tabel 'ratings'
        Schema::table('ratings', function (Blueprint $table) {
            // Ini mencegah satu user memberikan rating lebih dari sekali pada resep yang sama
            $table->unique(['user_id', 'recipe_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus batasan unik jika migrasi di-rollback
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'recipe_id']);
        });
    }
};