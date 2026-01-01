<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(SourceSeeder::class);
        // $this->call(StatusSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(EmailTemplatesSeeder::class);
        $this->call(AiPromptsTableSeeder::class);
        $this->call(CannedRepliesTableSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(ContactNotesSeeder::class);
        $this->call(ChatSeeder::class);
        $this->call(ChatMessagesSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(NotificationsSeeder::class);
        $this->call(PusherNotificationsSeeder::class);
        $this->call(WmActivityLogsSeeder::class);
    }
}
