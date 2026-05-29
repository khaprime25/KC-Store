<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\User;
use App\Models\ProductVariant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductVariantSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('adminpassword'),
            'role' => 'admin', // Role is 'admin'
        ]);
        
        User::create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'user', // Default role is 'user'
        ]);
        
        Payment::create([
            'method' => "Kpay",
            'account_name' => "Kaung Htet Aung",
            'account_number' => "09687564689"
        ]);

        Payment::create([
            'method' => "Wave",
            'account_name' => "Caxper",
            'account_number' => "09980529369"
        ]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            ProductVariantSeeder::class
        ]);
    }
}
