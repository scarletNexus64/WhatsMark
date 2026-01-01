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
            $table->string('firstname');
            $table->string('lastname');
            $table->string('company')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->foreignId('assigned_id')->nullable()->constrained('users');
            $table->enum('status', ['pending', 'sent', 'delivered', 'read', 'failed'])->default('pending')->after('message_id');
            $table->foreignId('source_id')->nullable()->constrained('sources');
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('phone');
            $table->boolean('is_enabled')->default(true);
            $table->foreignId('addedfrom')->nullable()->constrained('users');
            $table->timestamp('dateassigned')->nullable();
            $table->timestamp('last_status_change')->nullable();
            $table->string('default_language')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->json('custom_fields')->nullable();
            $table->timestamps();
        });

        // Create chat table
        Schema::create('chat', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('receiver_id')->nullable();
            $table->text('last_message')->nullable();
            $table->timestamp('last_msg_time')->nullable();
            $table->string('wa_no')->nullable();
            $table->string('wa_no_id')->nullable();
            $table->timestamp('time_sent')->nullable();
            $table->string('type')->nullable();
            $table->string('type_id')->nullable();
            $table->text('agent')->nullable();
            $table->boolean('is_ai_chat')->default(false);
            $table->longText('ai_message_json')->nullable();
            $table->boolean('is_bots_stoped')->default(false);
            $table->timestamp('bot_stoped_time')->nullable();
            $table->timestamps();
        });

        // Create chat_messages table
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('interaction_id')->nullable();
            $table->string('sender_id')->nullable();
            $table->string('url')->nullable();
            $table->text('message');
            $table->string('status')->nullable();
            $table->timestamp('time_sent')->nullable();
            $table->string('message_id')->nullable();
            $table->string('staff_id')->nullable();
            $table->string('type')->nullable();
            $table->boolean('is_read')->default(false);
            $table->string('ref_message_id')->nullable();
            $table->text('status_message')->nullable();
            $table->timestamps();
        });

        // Create notifications table
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });

        // Create ai_prompts table
        Schema::create('ai_prompts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('action');
            $table->boolean('is_public')->default(false);
            $table->unsignedBigInteger('added_from')->nullable();
            $table->timestamps();
        });

        // Create wm_activity_logs table
        Schema::create('wm_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number_id')->nullable();
            $table->string('access_token')->nullable();
            $table->string('business_account_id')->nullable();
            $table->string('response_code')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->longText('response_data')->nullable();
            $table->string('category')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('rel_type')->nullable();
            $table->unsignedBigInteger('rel_id')->nullable();
            $table->longText('category_params')->nullable();
            $table->longText('raw_data')->nullable();
            $table->timestamp('recorded_at')->nullable();
            $table->timestamps();
        });

        // Create pusher_notifications table
        Schema::create('pusher_notifications', function (Blueprint $table) {
            $table->id();
            $table->boolean('isread')->default(false);
            $table->boolean('isread_inline')->default(false);
            $table->timestamp('date')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('fromuserid')->nullable();
            $table->unsignedBigInteger('fromclientid')->nullable();
            $table->string('from_fullname')->nullable();
            $table->unsignedBigInteger('touserid')->nullable();
            $table->unsignedBigInteger('fromcompany')->nullable();
            $table->string('link')->nullable();
            $table->longText('additional_data')->nullable();
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
