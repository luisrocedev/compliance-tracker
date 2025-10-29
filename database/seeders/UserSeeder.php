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
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@demo.com'],
            [
                'name' => 'Admin Principal',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        foreach ([1, 2, 3] as $i) {
            \App\Models\User::firstOrCreate(
                ['email' => "manager{$i}@demo.com"],
                [
                    'name' => 'Manager ' . $i,
                    'password' => bcrypt('password'),
                    'role' => 'manager',
                ]
            );
        }

        foreach ([1, 2] as $i) {
            \App\Models\User::firstOrCreate(
                ['email' => "viewer{$i}@demo.com"],
                [
                    'name' => 'Viewer ' . $i,
                    'password' => bcrypt('password'),
                    'role' => 'viewer',
                ]
            );
        }
    }
}
