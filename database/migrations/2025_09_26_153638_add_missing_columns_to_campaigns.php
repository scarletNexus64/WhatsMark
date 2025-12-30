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
        Schema::table('campaigns', function (Blueprint $table) {
            $table->boolean('is_sent')->default(false)->after('failed_count');
            $table->boolean('is_active')->default(true)->after('is_sent');
            $table->json('settings')->nullable()->after('is_active');
            $table->decimal('progress', 5, 2)->default(0)->after('settings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['is_sent', 'is_active', 'settings', 'progress']);
        });
    }
};
