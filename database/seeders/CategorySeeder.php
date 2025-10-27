<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'E-Liquids']);
        Category::create(['name' => 'Vape Kits']);
        Category::create(['name' => 'Mods']);
        Category::create(['name' => 'Tanks']);
        Category::create(['name' => 'Coils']);
    }
}
