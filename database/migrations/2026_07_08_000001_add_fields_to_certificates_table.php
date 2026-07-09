<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->date('expiration_date')->nullable()->after('issued_at');
            $table->string('credential_url', 500)->nullable()->after('pdf_path');
        });
    }

    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn(['expiration_date', 'credential_url']);
        });
    }
};
