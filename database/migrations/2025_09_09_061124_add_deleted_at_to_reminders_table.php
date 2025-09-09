<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('reminders', function (Blueprint $table) {
            $table->softDeletes(); // bikin kolom deleted_at (nullable timestamp)
        });
    }

    public function down(): void
    {
        Schema::table('reminders', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
