<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('123456'),
                'role_id' => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'password' => Hash::make('123456'),
                'role_id' => 2,
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => Hash::make('123456'),
                'role_id' => 3,
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
        ];

        if (DB::table('users')->insert($users)) {
            $this->command->info('Users inserted successfully');
        } else {
            $this->command->info('Users already exist');
        }
    }
}
