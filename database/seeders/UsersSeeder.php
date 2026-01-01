<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 100) as $index) {
            User::updateOrCreate(
                ['email' => 'kira' . $index . '@wa.com'],
                [
                    'firstname'         => 'Kira',
                    'lastname'          => 'User ' . $index,
                    'password'          => Hash::make('password'),
                    'phone'             => '+1234567890',
                    'is_admin'          => 0,
                    'send_welcome_mail' => 0,
                    'active'            => 1,
                ]
            );
        }
    }
}
