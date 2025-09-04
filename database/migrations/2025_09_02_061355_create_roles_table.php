<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // contoh: Admin, Staff, Viewer
            $table->unsignedTinyInteger('level');   // 1, 2, 3
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // ubah tabel users supaya foreign ke roles
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')
                  ->nullable()
                  ->constrained('roles')
                  ->nullOnDelete();
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('role_id');
        });
        Schema::dropIfExists('roles');
    }
};
