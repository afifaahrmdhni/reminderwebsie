<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Buat tabel roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Super User, Multi User, Basic User
        });

        // Tambah foreign key di users -> roles
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')
                  ->nullOnDelete();
        });
    }

    public function down(): void {
        // Drop foreign key dulu supaya rollback tidak error
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });

        Schema::dropIfExists('roles');
    }
};
