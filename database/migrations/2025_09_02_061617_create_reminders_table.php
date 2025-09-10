<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('reminder_categories')->onDelete('cascade');
            $table->date('due_date')->nullable();
            $table->json('recipient_emails')->nullable(); // bisa lebih dari 1
            $table->json('recipient_phones')->nullable(); // bisa lebih dari 1
            $table->timestamps();
            $table->softDeletes(); // <--- tambahin ini
        });
    }

    public function down(): void {
        Schema::dropIfExists('reminders');
    }
};
