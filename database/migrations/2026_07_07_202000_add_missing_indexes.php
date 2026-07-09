<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->index('skill_category_id');
            $table->index('featured');
            $table->index('order');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->index('project_category_id');
            $table->index('status');
            $table->index('featured');
        });

        Schema::table('project_images', function (Blueprint $table) {
            $table->index('project_id');
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('heroes', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->index('is_current');
            $table->index('order');
        });

        Schema::table('educations', function (Blueprint $table) {
            $table->index('is_current');
            $table->index('order');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->index('is_active');
            $table->index('order');
        });

        Schema::table('social_media', function (Blueprint $table) {
            $table->index('is_active');
            $table->index('order');
        });
    }

    public function down(): void
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->dropIndex(['skill_category_id']);
            $table->dropIndex(['featured']);
            $table->dropIndex(['order']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['project_category_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['featured']);
        });

        Schema::table('project_images', function (Blueprint $table) {
            $table->dropIndex(['project_id']);
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('heroes', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->dropIndex(['is_current']);
            $table->dropIndex(['order']);
        });

        Schema::table('educations', function (Blueprint $table) {
            $table->dropIndex(['is_current']);
            $table->dropIndex(['order']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['order']);
        });

        Schema::table('social_media', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['order']);
        });
    }
};
