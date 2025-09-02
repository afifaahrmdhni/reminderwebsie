<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Karyawan Level 1',
                'email' => 'level1@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Karyawan Level 2',
                'email' => 'level2@example.com',
                'password' => Hash::make('password'),
                'role_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Karyawan Level 3',
                'email' => 'level3@example.com',
                'password' => Hash::make('password'),
                'role_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
