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
        Schema::table('hero_backgrounds', function (Blueprint $table) {
            $table->integer('duration')->nullable()->after('poster');
        });
    }

    public function down(): void
    {
        Schema::table('hero_backgrounds', function (Blueprint $table) {
            $table->dropColumn('duration');
        });
    }
};
