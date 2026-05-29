<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [ 
                'item' => 'Cigarette', 
                'brand' => 'Winston Dark Blue',
                'description' => 'Fair Price to High Performance Cigarette',
                'category_id' => Category::where('name', 'Goods')->first()->id
            ],
            [ 
                'item' => 'Coffee', 
                'brand' => 'NesCafe',
                'description' => 'Fair Price to High Performance Coffee',
                'category_id' => Category::where('name', 'Goods')->first()->id
            ],
            [ 
                'item' => 'Coffee', 
                'brand' => 'Birdy',
                'description' => 'Fair Price to High Performance Coffee',
                'category_id' => Category::where('name', 'Goods')->first()->id
            ],
            [ 
                'item' => 'Long Rice', 
                'brand' => 'Premium Thai Rice',
                'description' => 'Fair Price to High Performance Rice',
                'category_id' => Category::where('name', 'Rice')->first()->id
            ],
            [ 
                'item' => 'Long Rice', 
                'brand' => 'Master Chef',
                'description' => 'Fair Price to High Performance Rice',
                'category_id' => Category::where('name', 'Rice')->first()->id
            ],
            [ 
                'item' => 'Long Rice', 
                'brand' => 'Blue Sick',
                'description' => 'Fair Price to High Performance Rice',
                'category_id' => Category::where('name', 'Rice')->first()->id
            ],
            [ 
                'item' => 'Long Rice', 
                'brand' => 'Basmati',
                'description' => 'Fair Price to High Performance Rice',
                'category_id' => Category::where('name', 'Rice')->first()->id
            ],
            [ 
                'item' => 'Peanut Oil', 
                'brand' => 'A M H',
                'description' => 'Fair Price to High Performance Oil',
                'category_id' => Category::where('name', 'Oil')->first()->id
            ],
            [ 
                'item' => 'Peanut Oil', 
                'brand' => 'Golden Maize',
                'description' => 'Fair Price to High Performance Oil',
                'category_id' => Category::where('name', 'Oil')->first()->id
            ],
            [ 
                'item' => 'Sunflower Oil', 
                'brand' => 'The King',
                'description' => 'Fair Price to High Performance Oil',
                'category_id' => Category::where('name', 'Oil')->first()->id
            ],
            [ 
                'item' => 'Sweet Powder', 
                'brand' => 'AJ',
                'description' => 'Fair Price to High Performance Powder',
                'category_id' => Category::where('name', 'Powders')->first()->id
            ],
            [ 
                'item' => 'Fish Powder ( Dashi )', 
                'brand' => 'U Ma Mi',
                'description' => 'Fair Price to High Performance Powder',
                'category_id' => Category::where('name', 'Powders')->first()->id
            ],
            [ 
                'item' => 'Chicken Powder', 
                'brand' => 'Know',
                'description' => 'Fair Price to High Performance Powder',
                'category_id' => Category::where('name', 'Powders')->first()->id
            ],
            [ 
                'item' => 'Salt', 
                'brand' => 'Dawat',
                'description' => 'Fair Price to High Performance Powder',
                'category_id' => Category::where('name', 'Powders')->first()->id
            ],
            [ 
                'item' => 'Salt', 
                'brand' => 'Cook Sense',
                'description' => 'Fair Price to High Performance Powder',
                'category_id' => Category::where('name', 'Powders')->first()->id
            ],
            [ 
                'item' => 'Toothpaste', 
                'brand' => 'Close Up',
                'description' => 'Fair Price to High Performance Cosmetics',
                'category_id' => Category::where('name', 'Cosmetics')->first()->id
            ],
            [ 
                'item' => 'Facial Wash', 
                'brand' => 'Nivea',
                'description' => 'Fair Price to High Performance Cosmetics',
                'category_id' => Category::where('name', 'Cosmetics')->first()->id
            ],
            [ 
                'item' => 'Snack Bag', 
                'brand' => 'Oishi',
                'description' => 'Fair Price to High Performance Snacks & Drinks',
                'category_id' => Category::where('name', 'Snacks & Drinks')->first()->id
            ],
            [ 
                'item' => 'Light Drinks', 
                'brand' => 'Milo',
                'description' => 'Fair Price to High Performance Snacks & Drinks',
                'category_id' => Category::where('name', 'Snacks & Drinks')->first()->id
            ],
            [ 
                'item' => 'Light Drinks', 
                'brand' => 'Pepsi',
                'description' => 'Fair Price to High Performance Snacks & Drinks',
                'category_id' => Category::where('name', 'Snacks & Drinks')->first()->id
            ],
            [ 
                'item' => 'Light Drinks', 
                'brand' => 'Cola',
                'description' => 'Fair Price to High Performance Snacks & Drinks',
                'category_id' => Category::where('name', 'Snacks & Drinks')->first()->id
            ],
            [ 
                'item' => 'Energy Drinks', 
                'brand' => 'Redbull',
                'description' => 'Fair Price to High Performance Snacks & Drinks',
                'category_id' => Category::where('name', 'Snacks & Drinks')->first()->id
            ],
            [ 
                'item' => 'Light Drinks', 
                'brand' => 'Sting',
                'description' => 'Fair Price to High Performance Snacks & Drinks',
                'category_id' => Category::where('name', 'Snacks & Drinks')->first()->id
            ],
            [ 
                'item' => 'Light Drinks', 
                'brand' => 'Sprite',
                'description' => 'Fair Price to High Performance Snacks & Drinks',
                'category_id' => Category::where('name', 'Snacks & Drinks')->first()->id
            ],
        ];

        foreach($products as $product) {
            Product::create($product);
        }
    }
}
