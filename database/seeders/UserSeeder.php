<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Account
        User::create([
            'name' => 'admin123',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Customer Account
        User::create([
            'name' => 'customer123',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('customer'),
            'role' => 'customer',
        ]);
    }
}
