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
        Schema::create('spits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lick_id')->constrained('licks', 'id')->cascadeOnDelete();
            $table->float('revenue');
            $table->timestamps();

            $table->index('lick_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spits');
    }
};
