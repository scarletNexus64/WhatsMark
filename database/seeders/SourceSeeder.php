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
        \App\Models\Source::firstOrCreate(
            ['id' => 1],
            ['name' => 'Default']
        );
        
        // Add some common default sources
        $sources = [
            'Website',
            'Social Media',
            'Email Campaign',
            'Referral',
            'Direct Contact',
            'WhatsApp'
        ];
        
        foreach ($sources as $source) {
            \App\Models\Source::firstOrCreate(['name' => $source]);
        }
    }
}
