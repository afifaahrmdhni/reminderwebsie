<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Super User'],
            ['id' => 2, 'name' => 'Normal User'],
            ['id' => 3, 'name' => 'Mid User'],
        ]);
    }
}
