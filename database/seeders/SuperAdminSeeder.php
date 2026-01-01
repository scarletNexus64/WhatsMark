<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate(
            ['name' => 'SuperAdmin', 'guard_name' => 'web'],
            ['name' => 'SuperAdmin', 'guard_name' => 'web']
        );

        $user = User::updateOrCreate(
            ['email' => 'sylnet@wh.test'],
            [
                'firstname'         => 'syl',
                'lastname'          => 'net',
                'password'          => Hash::make('password'),
                'phone'             => '+1234567890',
                'is_admin'          => 1,
                'send_welcome_mail' => 0,
                'active'            => 1,
                'email_verified_at' => now(),
            ]
        );

        if (! $user->hasRole($superAdminRole->name)) {
            $user->assignRole($superAdminRole);
        }
    }
}
