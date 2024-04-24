<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'admin',
            'address' => 'computer'
        ]);

        DB::table('users')->insert([
            'name' => 'staff',
            'username' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'staff',
            'address' => 'computer'
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'user',
            'address' => 'computer'
        ]);

        // User::create([
        //     'name' => 'admin',
        //     'username' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('123'),
        //     'role' => 'admin',
        //     'address' => 'computer'
        // ]);
        
    }
}
