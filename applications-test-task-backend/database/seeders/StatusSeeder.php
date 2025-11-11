<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            [
                'name'       => 'pending',
                'color'      => '#b99412',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'approved',
                'color'      => '#459125',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
