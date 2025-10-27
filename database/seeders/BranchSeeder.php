<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::create(['name' => 'Downtown Vapes', 'address' => '123 Main St']);
        Branch::create(['name' => 'Uptown Smoke', 'address' => '456 High St']);
        Branch::create(['name' => 'Suburban Clouds', 'address' => '789 Low St']);
    }
}
