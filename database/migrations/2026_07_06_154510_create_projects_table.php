<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('project_category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('thumbnail_path')->nullable();
            $table->string('video_url')->nullable();
            $table->text('description')->nullable();
            $table->text('technology_stack')->nullable(); // comma separated technologies
            $table->string('github_url')->nullable();
            $table->string('live_demo_url')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->boolean('featured')->default(false);
            $table->string('client')->nullable();
            $table->date('date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
