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
        $products = [
            [
                'name' => 'Vintage Denim Jeans',
                'description' => 'Authentic vintage denim jeans with a touch of retro charm. Crafted with durability and style in mind, these jeans will never go out of fashion.',
                'price' => mt_rand(100000, 500000),
            ],
            [
                'name' => 'Classic Leather Jacket',
                'description' => 'Embrace the timeless appeal of this classic leather jacket. Made from premium leather and designed for both style and comfort.',
                'price' => mt_rand(100000, 500000),
            ],
            [
                'name' => 'Retro Record Player',
                'description' => 'Rediscover the joy of vinyl with this vintage record player. Immerse yourself in the warm sound of your favorite records with modern convenience.',
                'price' => mt_rand(100000, 500000),
            ],
            [
                'name' => 'Antique Brass Telescope',
                'description' => 'Explore the stars and distant horizons with this beautifully crafted antique brass telescope. A true piece of history that invites you to explore the world.',
                'price' => mt_rand(100000, 500000),
            ],
            [
                'name' => 'Art Deco Wall Clock',
                'description' => 'Add a touch of elegance to your space with this art deco-inspired wall clock. Its unique design and reliable functionality make it a timeless accent piece.',
                'price' => mt_rand(100000, 500000),
            ],
            [
                'name' => 'Vintage Silk Scarf',
                'description' => 'Wrap yourself in luxury with this vintage silk scarf. The intricate patterns and soft texture make it a versatile accessory for any occasion.',
                'price' => mt_rand(100000, 500000),
            ],
            [
                'name' => 'Handcrafted Wooden Chest',
                'description' => 'Store your treasures in style with this handcrafted wooden chest. Its intricate carvings and sturdy construction showcase the artistry of the past.',
                'price' => mt_rand(100000, 500000),
            ],
            [
                'name' => 'Retro Polaroid Camera',
                'description' => 'Capture memories with vintage flair using this retro polaroid camera. Instantly print photos that carry the charm of a bygone era.',
                'price' => mt_rand(100000, 500000),
            ],
            [
                'name' => 'Classic Typewriter',
                'description' => 'Experience the nostalgia of typing on a classic typewriter. Its timeless design and mechanical keys offer a satisfying writing experience.',
                'price' => mt_rand(100000, 500000),
            ],
            [
                'name' => 'Vintage Tea Set',
                'description' => 'Enjoy tea time in style with this elegant vintage tea set. Delicate designs and fine craftsmanship make every cup a delightful experience.',
                'price' => mt_rand(100000, 500000),
            ],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
            ]);
        }        //
    }
}
