<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('social_media', function (Blueprint $table) {
            $table->id();
            $table->string('platform'); // github, linkedin, instagram, etc.
            $table->string('label');
            $table->string('url');
            $table->string('icon')->nullable(); // SVG or icon class
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('social_media');
    }
};
