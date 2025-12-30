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
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->timestamp('time_sent')->nullable()->after('is_read');
            $table->string('message_id')->nullable()->after('time_sent');
            $table->enum('status', ['pending', 'sent', 'delivered', 'read', 'failed'])->default('pending')->after('message_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->dropColumn(['time_sent', 'message_id', 'status']);
        });
    }
};
