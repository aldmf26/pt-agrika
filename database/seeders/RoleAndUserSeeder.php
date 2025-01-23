<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleAndUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $presidenRole = Role::firstOrCreate(['name' => 'presiden']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $presiden = User::updateOrCreate(
            ['email' => 'presiden@example.com'],
            [
                'name' => 'Presiden',
                'email' => 'presiden@example.com',
                'password' => Hash::make('password')
            ]
        );

        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password')
            ]
        );

        $presiden->assignRole('presiden');
        $admin->assignRole('admin');
    }
}
