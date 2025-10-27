<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'branch_id' => null,
        ]);

        User::create([
            'name' => 'Staff User 1',
            'username' => 'staff1',
            'password' => bcrypt('password'),
            'role' => 'staff',
            'branch_id' => 1,
        ]);

        User::create([
            'name' => 'Staff User 2',
            'username' => 'staff2',
            'password' => bcrypt('password'),
            'role' => 'staff',
            'branch_id' => 2,
        ]);

        User::create([
            'name' => 'Customer User',
            'username' => 'customer',
            'password' => bcrypt('password'),
            'role' => 'customer',
            'branch_id' => null,
        ]);
    }
}
