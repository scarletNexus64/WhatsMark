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
        // Create contacts table
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('email')->nullable();
            $table->foreignId('status_id')->nullable()->constrained('statuses');
            $table->foreignId('source_id')->nullable()->constrained('sources');
            $table->foreignId('assigned_id')->nullable()->constrained('users');
            $table->timestamps();
        });

        // Create chat table
        Schema::create('chat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained('contacts');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();
        });

        // Create chat_messages table
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained('chat');
            $table->text('message');
            $table->enum('type', ['incoming', 'outgoing'])->default('incoming');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // Create notifications table
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('message');
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // Create ai_prompts table
        Schema::create('ai_prompts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('prompt');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Create wm_activity_logs table
        Schema::create('wm_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('action');
            $table->text('description')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
        });

        // Create pusher_notifications table
        Schema::create('pusher_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('message');
            $table->string('channel');
            $table->json('data')->nullable();
            $table->timestamps();
        });

        // Create countries table
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 3)->unique();
            $table->string('flag')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pusher_notifications');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('wm_activity_logs');
        Schema::dropIfExists('ai_prompts');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('chat_messages');
        Schema::dropIfExists('chat');
        Schema::dropIfExists('contacts');
    }
};
