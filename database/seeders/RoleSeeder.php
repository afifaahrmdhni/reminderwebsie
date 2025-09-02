<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Admin', 'description' => 'Full access to system'],
            ['name' => 'Level 1', 'description' => 'Tambah/Edit/Hapus reminder'],
            ['name' => 'Level 2', 'description' => 'Tambah reminder saja'],
            ['name' => 'Level 3', 'description' => 'Hanya bisa lihat reminder'],
        ]);
    }
}
