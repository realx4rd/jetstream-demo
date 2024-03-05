<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        foreach(['users','roles','permissions'] as $name) {

            $permission = Permission::create([
                'name' => $name,
                'guard_name' => 'web',
            ]);

            $adminRole->givePermissionTo($permission);
        }

        $admin->assignRole($adminRole);
    }
}
