<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin default
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // 🔑 password default
            'role_id' => 4, // Admin
        ]);

        // Super User
        User::create([
            'name' => 'Super User',
            'email' => 'super@example.com',
            'password' => Hash::make('super123'),
            'role_id' => 2,
        ]);

        // Multi User
        User::create([
            'name' => 'Multi User',
            'email' => 'multi@example.com',
            'password' => Hash::make('multi123'),
            'role_id' => 3,
        ]);

        // Basic User
        User::create([
            'name' => 'Basic User',
            'email' => 'basic@example.com',
            'password' => Hash::make('basic123'),
            'role_id' => 1,
        ]);
    }
}
