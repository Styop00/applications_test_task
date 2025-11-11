<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'user@user.com')->first();
        $statuses = Status::all();
        $cities = City::all();
        $data = [];

        for ($i = 0; $i < 70; $i++) {
            $data [] = [
                'name'        => fake()->name(),
                'description' => fake()->realText('500'),
                'status_id'   => $statuses->random()->id,
                'city_id'     => $cities->random()->id,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        $user->applications()->createMany($data);
    }
}
