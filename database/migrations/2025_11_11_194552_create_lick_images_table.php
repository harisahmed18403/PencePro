<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lick_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lick_id')->constrained('licks', 'id')->cascadeOnDelete();
            $table->string('image_path');
            $table->string('note')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lick_images');
    }
};
