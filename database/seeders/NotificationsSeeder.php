<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $userIds = DB::table('users')->pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            DB::table('notifications')->insert([
                'id'              => $faker->uuid,
                'type'            => $faker->word,
                'notifiable_type' => 'App\\Models\\User', // or any other model
                'notifiable_id'   => $userIds ? $userIds[array_rand($userIds)] : 1,
                'data'            => json_encode([
                    'message' => $faker->sentence,
                    'type'    => $faker->word,
                ]),
                'read_at'         => $faker->boolean ? now() : null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}
