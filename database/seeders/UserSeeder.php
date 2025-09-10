<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Super User',
            'email' => 'super@example.com',
            'password' => Hash::make('super123'),
            'role' => 'Super User',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Multi User',
            'email' => 'multi@example.com',
            'password' => Hash::make('multi123'),
            'role' => 'Multi User',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Basic User',
            'email' => 'basic@example.com',
            'password' => Hash::make('basic123'),
            'role' => 'Basic User',
            'is_active' => true,
        ]);
    }
}
