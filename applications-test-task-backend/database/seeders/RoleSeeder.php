<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('roles')->insert([
            ['name' => 'admin', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'user', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
        ]);

        $role = Role::where('name', 'admin')->first();
        $permission = Permission::query()->where('name', 'delete applications')->first();
        $role->givePermissionTo($permission);
    }
}
