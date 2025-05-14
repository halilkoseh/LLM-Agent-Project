<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('model_output_id')->constrained()->onDelete('cascade');
            $table->integer('rating'); // 1-5 arası puan
            $table->text('feedback_text')->nullable(); // Ekstra yorum
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_feedbacks');
    }
};
