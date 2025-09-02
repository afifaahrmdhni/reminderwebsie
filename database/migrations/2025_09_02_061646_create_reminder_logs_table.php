<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reminder_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reminder_id')->constrained('reminders')->onDelete('cascade');
            $table->string('action');
            $table->foreignId('performed_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('timestamp')->useCurrent();
        });
    }

    public function down(): void {
        Schema::dropIfExists('reminder_logs');
    }
};