<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super-admin@test.com',
            'password' => Hash::make('pa$$word')
        ]);

        $superAdmin->assignRole('super_admin');

        $admin = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => Hash::make('password')
        ]);

        $admin->assignRole('admin');
    }
}
