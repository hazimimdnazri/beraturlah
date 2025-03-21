<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'role' => 'superadmin',
                'description' => 'Super Admin',
                'is_active' => true,
            ],
            [
                'role' => 'admin',
                'description' => 'Admin',
                'is_active' => true,
            ],
            [
                'role' => 'user',
                'description' => 'User',
                'is_active' => true,
            ],
        ];

        if (DB::table('roles')->insert($roles)) {
            $this->command->info('Roles inserted successfully');
        } else {
            $this->command->info('Roles already exist');
        }
    }
}
