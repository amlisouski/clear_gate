<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'super_admin'
        ]);

        $admin = Role::create([
            'name' => 'admin'
        ]);

        $admin->givePermissionTo([
            'user.create',
            'user.edit',
            'user.delete',
        ]);
    }
}
