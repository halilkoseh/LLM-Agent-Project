<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('model_outputs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained()->onDelete('cascade');
            $table->foreignId('model_id')->constrained()->onDelete('cascade');
            $table->longText('output_content'); // Modelin ürettiği çıktı
            $table->float('processing_time')->nullable(); // İşlem süresi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('model_outputs');
    }
};
