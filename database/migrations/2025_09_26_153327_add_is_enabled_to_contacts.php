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
            if (! Schema::hasColumn('contacts', 'is_enabled')) {
                $table->boolean('is_enabled')->default(true)->after('assigned_id');
            }
            if (! Schema::hasColumn('contacts', 'last_activity')) {
                $table->timestamp('last_activity')->nullable()->after('is_enabled');
            }
            if (! Schema::hasColumn('contacts', 'custom_fields')) {
                $table->json('custom_fields')->nullable()->after('last_activity');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $columns = [];
            if (Schema::hasColumn('contacts', 'is_enabled')) {
                $columns[] = 'is_enabled';
            }
            if (Schema::hasColumn('contacts', 'last_activity')) {
                $columns[] = 'last_activity';
            }
            if (Schema::hasColumn('contacts', 'custom_fields')) {
                $columns[] = 'custom_fields';
            }
            if (! empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
