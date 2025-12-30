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
        // Create campaign_details table
        Schema::create('campaign_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained('campaigns')->onDelete('cascade');
            $table->foreignId('contact_id')->constrained('contacts')->onDelete('cascade');
            $table->enum('status', ['pending', 'sent', 'delivered', 'read', 'failed'])->default('pending');
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
        });

        // Create canned_replies table
        Schema::create('canned_replies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('message');
            $table->json('shortcuts')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });

        // Create contact_notes table
        Schema::create('contact_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained('contacts')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->text('note');
            $table->timestamps();
        });

        // Create webhook_logs table
        Schema::create('webhook_logs', function (Blueprint $table) {
            $table->id();
            $table->string('webhook_type');
            $table->json('payload');
            $table->string('source_ip')->nullable();
            $table->integer('response_code')->nullable();
            $table->text('response_message')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });

        // Create message_bots table
        Schema::create('message_bots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('triggers'); // Keywords or patterns
            $table->longText('response');
            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(0);
            $table->timestamps();
        });

        // Create template_bots table
        Schema::create('template_bots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('template_id')->constrained('whatsapp_templates');
            $table->json('triggers');
            $table->json('parameters')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_bots');
        Schema::dropIfExists('message_bots');
        Schema::dropIfExists('webhook_logs');
        Schema::dropIfExists('contact_notes');
        Schema::dropIfExists('canned_replies');
        Schema::dropIfExists('campaign_details');
    }
};
