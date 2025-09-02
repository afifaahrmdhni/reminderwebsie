<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReminderCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reminder_categories')->insert([
            ['name' => 'Catering', 'icon' => '🍱'],
            ['name' => 'Domain', 'icon' => '🌐'],
            ['name' => 'Lisensi Software', 'icon' => '💻'],
        ]);
    }
}
