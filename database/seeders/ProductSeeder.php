<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Super Cool Product',
            'description' => 'A very cool product with amazing features.',
            'price' => 199.99,
            'stock_quantity' => 100,
            'image' => null, // Leaving the image field null
        ]);

        Product::create([
            'name' => 'Awesome Gadget',
            'description' => 'An awesome gadget that everyone will love.',
            'price' => 299.99,
            'stock_quantity' => 50,
            'image' => null, // Leaving the image field null
        ]);

        Product::create([
            'name' => 'Cool Accessory',
            'description' => 'A must-have accessory for your gadgets.',
            'price' => 49.99,
            'stock_quantity' => 200,
            'image' => null, // Leaving the image field null
        ]);
    }
}
