<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('models', function (Blueprint $table) {
            $table->id();
            $table->string('model_name'); // GPT-4, Gemini, LLaMA vs.
            $table->string('provider'); // OpenAI, Google, Meta
            $table->string('version')->nullable();
            $table->json('capabilities')->nullable(); // JSON olarak özellikler
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('models');
    }
};
