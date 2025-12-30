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
        Schema::create('whatsapp_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('template_id')->nullable();
            $table->string('language')->default('en');
            $table->enum('category', ['MARKETING', 'UTILITY', 'AUTHENTICATION'])->default('UTILITY');
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED', 'DISABLED'])->default('PENDING');
            $table->longText('header_text')->nullable();
            $table->longText('body_text');
            $table->longText('footer_text')->nullable();
            $table->json('buttons')->nullable();
            $table->json('header_params')->nullable();
            $table->json('body_params')->nullable();
            $table->string('header_type')->nullable(); // TEXT, IMAGE, VIDEO, DOCUMENT
            $table->string('header_media_url')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whatsapp_templates');
    }
};
