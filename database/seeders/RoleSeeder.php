<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // buat roles
        $roles = ['Admin', 'Super User', 'Multi User', 'Basic User'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // ambil role admin
        $adminRole = Role::where('name', 'Admin')->first();

        // buat user admin default
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
                'role_id' => $adminRole->id,
                'is_active' => true
            ]
        );
    }
}
