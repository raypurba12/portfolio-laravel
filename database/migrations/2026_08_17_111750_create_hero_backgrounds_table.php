<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Table already exists from earlier migration — skip
        if (Schema::hasTable('hero_backgrounds')) return;

        Schema::create('hero_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['image', 'video'])->default('image');
            $table->string('url', 500);
            $table->string('poster', 500)->nullable();
            $table->unsignedInteger('duration')->default(5000);
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('hero_backgrounds');
    }
};
