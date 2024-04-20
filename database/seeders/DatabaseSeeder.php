<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            // 'name' => 'admin',
            // 'username' => 'admin',
            // 'email' => 'admin@tester.com',
            // 'password' => bcrypt('123'),
            // 'role' => 'admin',
            // 'address' => 'comp'

            // 'name' => 'staff',
            // 'username' => 'staff',
            // 'email' => 'staff@tester.com',
            // 'password' => bcrypt('123'),
            // 'role' => 'staff',
            // 'address' => 'comp'

            'name' => 'user',
            'username' => 'user',
            'email' => 'user@tester.com',
            'password' => bcrypt('123'),
            'role' => 'user',
            'address' => 'comp'
        ]);
    }
}
