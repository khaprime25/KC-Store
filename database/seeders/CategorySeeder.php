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
        $categories = [
            ["name" => 'Goods', "description" => "All type of Goods"],
            ["name" => 'Rice', 'description' => "All type of Rice"],
            ["name" => 'Oil', 'description' => "All type of Oils"],
            ["name" => 'Powders', 'description' => "All type of Powders"],
            ["name" => 'Snacks & Drinks', 'description' => "All type of Snacks"],
            ["name" => 'Cosmetics', 'description' => "All type of Cosmetics"],
        ];
        
        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']], // Check condition (name must match)
                ['description' => $category['description']] // Additional attributes
            );
        }

    }
}
