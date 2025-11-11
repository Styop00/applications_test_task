<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::query()->create([
            'name'     => 'Admin',
            'email'    => 'admin@admin.com',
            'password' => Hash::make('admin123'),
        ]);
        $user = User::query()->create([
            'name'     => 'User',
            'email'    => 'user@user.com',
            'password' => Hash::make('user123'),
        ]);

        $roles = Role::all();

        $admin->roles()->sync($roles->where('name', 'admin')->pluck('id'));
        $user->roles()->sync($roles->where('name', 'user')->pluck('id'));
    }
}
