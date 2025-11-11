<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        $cities = [
            'New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix',
            'Philadelphia', 'San Antonio', 'San Diego', 'Dallas', 'San Jose',
            'Austin', 'Jacksonville', 'San Francisco', 'Columbus', 'Indianapolis',
            'Fort Worth', 'Charlotte', 'Seattle', 'Denver', 'El Paso',
            'Detroit', 'Washington', 'Boston', 'Memphis', 'Nashville',
            'Portland', 'Oklahoma City', 'Las Vegas', 'Baltimore', 'Louisville',
            'Milwaukee', 'Albuquerque', 'Tucson', 'Fresno', 'Sacramento',
            'Kansas City', 'Mesa', 'Atlanta', 'Omaha', 'Colorado Springs',
            'Raleigh', 'Miami', 'Long Beach', 'Virginia Beach', 'Oakland',
            'Minneapolis', 'Tulsa', 'Tampa', 'Arlington', 'New Orleans',
            'Wichita', 'Cleveland', 'Bakersfield', 'Aurora', 'Anaheim',
            'Honolulu', 'Santa Ana', 'Riverside', 'Corpus Christi', 'Lexington',
            'Stockton', 'Henderson', 'Saint Paul', 'St. Louis', 'Cincinnati',
            'Pittsburgh', 'Greensboro', 'Anchorage', 'Plano', 'Lincoln',
            'Orlando', 'Irvine', 'Newark', 'Toledo', 'Durham',
            'Chula Vista', 'Fort Wayne', 'Jersey City', 'St. Petersburg', 'Laredo',
            'Madison', 'Chandler', 'Buffalo', 'Lubbock', 'Scottsdale',
            'Reno', 'Glendale', 'Gilbert', 'Winston–Salem', 'North Las Vegas',
            'Norfolk', 'Chesapeake', 'Garland', 'Irving', 'Hialeah',
            'Fremont', 'Boise', 'Richmond', 'Spokane', 'Baton Rouge',
        ];

        DB::table('cities')->insert(array_map(fn($name) => [
            'name' => $name,
            'created_at' => $now,
            'updated_at' => $now,
        ], $cities));
    }
}
