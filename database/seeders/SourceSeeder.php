<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedSources = [
            ['id' => 1, 'name' => 'facebook'],
            ['id' => 2, 'name' => 'whatsapp'],
            ['id' => 3, 'name' => 'saas'],
            ['name' => 'Default'],
            ['name' => 'Website'],
            ['name' => 'Social Media'],
            ['name' => 'Email Campaign'],
            ['name' => 'Referral'],
            ['name' => 'Direct Contact'],
        ];

        foreach ($seedSources as $source) {
            if (isset($source['id'])) {
                \App\Models\Source::updateOrCreate(
                    ['id' => $source['id']],
                    ['name' => $source['name']]
                );
                continue;
            }

            \App\Models\Source::updateOrCreate(
                ['name' => $source['name']],
                ['name' => $source['name']]
            );
        }
    }
}
