<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Admin, Super User, Multi User, Basic User
            $table->timestamps();
        });

        // setelah roles ada, baru hubungkan ke users
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')
                  ->references('id')->on('roles')
                  ->nullOnDelete();
        });
    }

    public function down(): void {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });
        Schema::dropIfExists('roles');
    }
};
