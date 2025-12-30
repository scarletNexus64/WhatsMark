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
        Schema::table('contacts', function (Blueprint $table) {
            $table->boolean('is_enabled')->default(true)->after('assigned_id');
            $table->timestamp('last_activity')->nullable()->after('is_enabled');
            $table->json('custom_fields')->nullable()->after('last_activity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['is_enabled', 'last_activity', 'custom_fields']);
        });
    }
};
