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
        // Add missing columns to users table
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('users', 'last_login')) {
                $table->timestamp('last_login')->nullable()->after('is_active');
            }
        });

        // Add missing columns to sources table
        Schema::table('sources', function (Blueprint $table) {
            if (!Schema::hasColumn('sources', 'description')) {
                $table->text('description')->nullable()->after('name');
            }
            if (!Schema::hasColumn('sources', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('description');
            }
            if (!Schema::hasColumn('sources', 'color')) {
                $table->string('color')->nullable()->after('is_active');
            }
        });

        // Add missing columns to whatsapp_templates table
        Schema::table('whatsapp_templates', function (Blueprint $table) {
            if (!Schema::hasColumn('whatsapp_templates', 'category_display_name')) {
                $table->string('category_display_name')->nullable()->after('category');
            }
            if (!Schema::hasColumn('whatsapp_templates', 'components')) {
                $table->json('components')->nullable()->after('body_params');
            }
            if (!Schema::hasColumn('whatsapp_templates', 'approved_at')) {
                $table->timestamp('approved_at')->nullable()->after('rejection_reason');
            }
        });

        // Add missing columns to chat table
        Schema::table('chat', function (Blueprint $table) {
            if (!Schema::hasColumn('chat', 'whatsapp_chat_id')) {
                $table->string('whatsapp_chat_id')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('chat', 'metadata')) {
                $table->json('metadata')->nullable()->after('last_message_at');
            }
            if (!Schema::hasColumn('chat', 'is_archived')) {
                $table->boolean('is_archived')->default(false)->after('metadata');
            }
        });

        // Add missing columns to notifications table
        Schema::table('notifications', function (Blueprint $table) {
            if (!Schema::hasColumn('notifications', 'type')) {
                $table->string('type')->default('info')->after('message');
            }
            if (!Schema::hasColumn('notifications', 'action_url')) {
                $table->string('action_url')->nullable()->after('type');
            }
            if (!Schema::hasColumn('notifications', 'data')) {
                $table->json('data')->nullable()->after('action_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn(['type', 'action_url', 'data']);
        });

        Schema::table('chat', function (Blueprint $table) {
            $table->dropColumn(['whatsapp_chat_id', 'metadata', 'is_archived']);
        });

        Schema::table('whatsapp_templates', function (Blueprint $table) {
            $table->dropColumn(['category_display_name', 'components', 'approved_at']);
        });

        Schema::table('sources', function (Blueprint $table) {
            $table->dropColumn(['description', 'is_active', 'color']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'avatar', 'is_active', 'last_login']);
        });
    }
};
