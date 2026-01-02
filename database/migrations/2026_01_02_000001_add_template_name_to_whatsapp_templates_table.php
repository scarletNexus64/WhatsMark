<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('whatsapp_templates', 'template_name')) {
            Schema::table('whatsapp_templates', function (Blueprint $table) {
                $table->string('template_name')->nullable()->after('template_id');
            });

            // Backfill from legacy "name" column when available.
            if (Schema::hasColumn('whatsapp_templates', 'name')) {
                DB::table('whatsapp_templates')
                    ->whereNull('template_name')
                    ->update(['template_name' => DB::raw('name')]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('whatsapp_templates', 'template_name')) {
            Schema::table('whatsapp_templates', function (Blueprint $table) {
                $table->dropColumn('template_name');
            });
        }
    }
};
