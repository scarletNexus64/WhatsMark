<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = base_path('platform/packages/corbital/installer/countries.json');

        if (! file_exists($path)) {
            return;
        }

        $countries = json_decode(file_get_contents($path), true) ?? [];

        foreach ($countries as $country) {
            $code = $country['iso2'] ?? null;
            $name = $country['short_name'] ?? null;

            if (! $code || ! $name) {
                continue;
            }

            DB::table('countries')->updateOrInsert(
                ['code' => $code],
                [
                    'name'       => $name,
                    'code'       => $code,
                    'flag'       => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
