<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsVariants = [
            // Cigarette
            [
                'price' => 30000,
                'size' => '1 box', 
                'stock' => 20,
                'description' => '1 Box contain 10 packs',
                'product_id' => Product::where('brand', 'Winston Dark Blue')->where('item', 'Cigarette')->first()->id,
                'image' => null
            ],
            [
                'price' => 3200,
                'size' => '1 pack', 
                'stock' => 20,
                'description' => '1 pack contain 20 cigarettes',
                'product_id' => Product::where('brand', 'Winston Dark Blue')->where('item', 'Cigarette')->first()->id,
                'image' => null
            ],
            // Coffee
            [
                'price' => 18000,
                'size' => 'Blend & Brew ( 24ps )', 
                'stock' => 20,
                'description' => 'A good day starts with a cup of coffee',
                'product_id' => Product::where('brand', 'NesCafe')->where('item', 'Coffee')->first()->id,
                'image' => null
            ],
            [
                'price' => 18000,
                'size' => 'Creamy Latte ( 24 ps )', 
                'stock' => 20,
                'description' => 'A good day starts with a cup of coffee',
                'product_id' => Product::where('brand', 'NesCafe')->where('item', 'Coffee')->first()->id,
                'image' => null
            ],
            [
                'price' => 20000,
                'size' => 'Expresso ( 24 ps )', 
                'stock' => 20,
                'description' => 'A good day starts with a cup of coffee',
                'product_id' => Product::where('brand', 'NesCafe')->where('item', 'Coffee')->first()->id,
                'image' => null
            ],
            [
                'price' => 18000,
                'size' => 'Ice Coffee', 
                'stock' => 20,
                'description' => 'A good day starts with a cup of coffee',
                'product_id' => Product::where('brand', 'NesCafe')->where('item', 'Coffee')->first()->id,
                'image' => null
            ],
            [
                'price' => 16000,
                'size' => 'Birdy', 
                'stock' => 20,
                'description' => 'A good day starts with a cup of coffee',
                'product_id' => Product::where('brand', 'Birdy')->where('item', 'Coffee')->first()->id,
                'image' => null
            ],
            // Rice
            [
                'price' => 42000,
                'size' => 'Premium Thai Rice ( 5 kg )', 
                'stock' => 20,
                'description' => 'A good meal for your Family',
                'product_id' => Product::where('brand', 'Premium Thai Rice')->where('item', 'Long Rice')->first()->id,
                'image' => null
            ],
            [
                'price' => 45000,
                'size' => 'Long Grain ( 5 kg )', 
                'stock' => 20,
                'description' => 'A good meal for your Family',
                'product_id' => Product::where('brand', 'Premium Thai Rice')->where('item', 'Long Rice')->first()->id,
                'image' => null
            ],
            [
                'price' => 220000,
                'size' => 'Large Portion ( 25 kg )', 
                'stock' => 20,
                'description' => 'A good meal for your Family',
                'product_id' => Product::where('brand', 'Master Chef')->where('item', 'Long Rice')->first()->id,
                'image' => null
            ],
            [
                'price' => 260000,
                'size' => 'Large Portion ( 25 kg )', 
                'stock' => 20,
                'description' => 'A premium meal for your Family',
                'product_id' => Product::where('brand', 'Blue Sick')->where('item', 'Long Rice')->first()->id,
                'image' => null
            ],
            [
                'price' => 320000,
                'size' => 'Large Portion ( 25 kg )', 
                'stock' => 20,
                'description' => 'A premium meal for your Family',
                'product_id' => Product::where('brand', 'Basmati')->where('item', 'Long Rice')->first()->id,
                'image' => null
            ],
            // Oil
            [
                'price' => 23000,
                'size' => '1 Viss', 
                'stock' => 20,
                'description' => 'Purtiy is priority for your health!',
                'product_id' => Product::where('brand', 'A M H')->where('item', 'Peanut Oil')->first()->id,
                'image' => null
            ],
            [
                'price' => 65000,
                'size' => '2.5 Viss', 
                'stock' => 20,
                'description' => 'Purtiy is priority for your health!',
                'product_id' => Product::where('brand', 'Golden Maize')->where('item', 'Peanut Oil')->first()->id,
                'image' => null
            ],
            [
                'price' => 25000,
                'size' => '1 Viss', 
                'stock' => 20,
                'description' => 'For your good heart health!',
                'product_id' => Product::where('brand', 'The King')->where('item', 'Sunflower Oil')->first()->id,
                'image' => null
            ],
            [
                'price' => 60000,
                'size' => '2.5 Viss', 
                'stock' => 20,
                'description' => 'For your good heart health!',
                'product_id' => Product::where('brand', 'The King')->where('item', 'Sunflower Oil')->first()->id,
                'image' => null
            ],
            [
                'price' => 115000,
                'size' => '5 Viss', 
                'stock' => 20,
                'description' => 'For your good heart health!',
                'product_id' => Product::where('brand', 'The King')->where('item', 'Sunflower Oil')->first()->id,
                'image' => null
            ],
            // Powders
            [
                'price' => 8000,
                'size' => 'Normal', 
                'stock' => 20,
                'description' => 'AJ is the best choice for seasoning!',
                'product_id' => Product::where('brand', 'AJ')->where('item', 'Sweet Powder')->first()->id,
                'image' => null
            ],
            [
                'price' => 12500,
                'size' => 'Normal', 
                'stock' => 20,
                'description' => 'Dashi is the best choice for seasoning!',
                'product_id' => Product::where('brand', 'U Ma Mi')->where('item', 'Fish Powder ( Dashi )')->first()->id,
                'image' => null
            ],
            [
                'price' => 2500,
                'size' => 'Small', 
                'stock' => 50,
                'description' => 'Know is the best choice for seasoning!',
                'product_id' => Product::where('brand', 'Know')->where('item', 'Chicken Powder')->first()->id,
                'image' => null
            ],
            [
                'price' => 6500,
                'size' => 'Big', 
                'stock' => 20,
                'description' => 'Dawat is the best choice for seasoning!',
                'product_id' => Product::where('brand', 'Dawat')->where('item', 'Salt')->first()->id,
                'image' => null
            ],
            [
                'price' => 6000,
                'size' => 'Big', 
                'stock' => 20,
                'description' => 'Cook Sense is the best choice for seasoning!',
                'product_id' => Product::where('brand', 'Cook Sense')->where('item', 'Salt')->first()->id,
                'image' => null
            ],
            // Cosmetics
            [
                'price' => 7000,
                'size' => 'Fresh ( Green )', 
                'stock' => 20,
                'description' => '24 hours fresh breath!',
                'product_id' => Product::where('brand', 'Close Up')->where('item', 'Toothpaste')->first()->id,
                'image' => null
            ],
            [
                'price' => 7500,
                'size' => 'Menthol ( Blue )', 
                'stock' => 20,
                'description' => '24 hours fresh breath!',
                'product_id' => Product::where('brand', 'Close Up')->where('item', 'Toothpaste')->first()->id,
                'image' => null
            ],
            [
                'price' => 8000,
                'size' => 'Strong ( Red )', 
                'stock' => 50,
                'description' => '24 hours fresh breath!',
                'product_id' => Product::where('brand', 'Close Up')->where('item', 'Toothpaste')->first()->id,
                'image' => null
            ],
            [
                'price' => 14000,
                'size' => 'Nivea Deep', 
                'stock' => 20,
                'description' => 'Good looking, Good Confidence!',
                'product_id' => Product::where('brand', 'Nivea')->where('item', 'Facial Wash')->first()->id,
                'image' => null
            ],
            [
                'price' => 12000,
                'size' => 'Nivea Hydra Max', 
                'stock' => 20,
                'description' => 'Good looking, Good Confidence!',
                'product_id' => Product::where('brand', 'Nivea')->where('item', 'Facial Wash')->first()->id,
                'image' => null
            ],
            [
                'price' => 13000,
                'size' => 'Nivea Acne', 
                'stock' => 20,
                'description' => 'Good looking, Good Confidence!',
                'product_id' => Product::where('brand', 'Nivea')->where('item', 'Facial Wash')->first()->id,
                'image' => null
            ],
            [
                'price' => 13000,
                'size' => 'Nivea Extra Bright', 
                'stock' => 20,
                'description' => 'Good looking, Good Confidence!',
                'product_id' => Product::where('brand', 'Nivea')->where('item', 'Facial Wash')->first()->id,
                'image' => null
            ],
            // Food And Snacks
            [
                'price' => 2000,
                'size' => 'Pillows', 
                'stock' => 20,
                'description' => 'Easy Bite, Tasty Snack',
                'product_id' => Product::where('brand', 'Oishi')->where('item', 'Snack Bag')->first()->id,
                'image' => null
            ],
            [
                'price' => 2000,
                'size' => 'Crispy', 
                'stock' => 20,
                'description' => 'Easy Bite, Tasty Snack',
                'product_id' => Product::where('brand', 'Oishi')->where('item', 'Snack Bag')->first()->id,
                'image' => null
            ],
            [
                'price' => 2000,
                'size' => 'Potato Fries', 
                'stock' => 50,
                'description' => 'Easy Bite, Tasty Snack',
                'product_id' => Product::where('brand', 'Oishi')->where('item', 'Snack Bag')->first()->id,
                'image' => null
            ],
            [
                'price' => 2000,
                'size' => 'PopCorns', 
                'stock' => 50,
                'description' => 'Easy Bite, Tasty Snack',
                'product_id' => Product::where('brand', 'Oishi')->where('item', 'Snack Bag')->first()->id,
                'image' => null
            ],
            [
                'price' => 2000,
                'size' => '1 pcs', 
                'stock' => 20,
                'description' => 'Need a drink? Remember me!!!',
                'product_id' => Product::where('brand', 'Milo')->where('item', 'Light Drinks')->first()->id,
                'image' => null
            ],
            [
                'price' => 3000,
                'size' => '1 pcs', 
                'stock' => 20,
                'description' => 'Need a drink? Remember me!!!',
                'product_id' => Product::where('brand', 'Pepsi')->where('item', 'Light Drinks')->first()->id,
                'image' => null
            ],
            [
                'price' => 3000,
                'size' => '1 pcs', 
                'stock' => 20,
                'description' => 'Need a drink? Remember me!!!',
                'product_id' => Product::where('brand', 'Cola')->where('item', 'Light Drinks')->first()->id,
                'image' => null
            ],
            [
                'price' => 1500,
                'size' => '1 pcs', 
                'stock' => 20,
                'description' => 'Need a drink? Remember me!!!',
                'product_id' => Product::where('brand', 'Sting')->where('item', 'Light Drinks')->first()->id,
                'image' => null
            ],
            [
                'price' => 2500,
                'size' => '1 pcs', 
                'stock' => 20,
                'description' => 'Need a drink? Remember me!!!',
                'product_id' => Product::where('brand', 'Sprite')->where('item', 'Light Drinks')->first()->id,
                'image' => null
            ],
            [
                'price' => 2500,
                'size' => '1 pcs', 
                'stock' => 20,
                'description' => 'Need a drink? Remember me!!!',
                'product_id' => Product::where('brand', 'Redbull')->where('item', 'Energy Drinks')->first()->id,
                'image' => null
            ],
        ];

        foreach($productsVariants as $productsVariant) {
            ProductVariant::create($productsVariant);
        }

    }
}
