<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@demo.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        foreach ([1, 2, 3] as $i) {
            \App\Models\User::create([
                'name' => 'Manager ' . $i,
                'email' => "manager{$i}@demo.com",
                'password' => bcrypt('password'),
                'role' => 'manager',
            ]);
        }

        foreach ([1, 2] as $i) {
            \App\Models\User::create([
                'name' => 'Viewer ' . $i,
                'email' => "viewer{$i}@demo.com",
                'password' => bcrypt('password'),
                'role' => 'viewer',
            ]);
        }
    }
}
