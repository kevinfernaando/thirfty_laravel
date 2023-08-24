<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Image::create([
            "product_id" => "1",
            "url" => "1-1.png"
        ]);
        Image::create([
            "product_id" => "1",
            "url" => "1-2.png"
        ]);
        Image::create([
            "product_id" => "2",
            "url" => "2-1.png"
        ]);
        Image::create([
            "product_id" => "2",
            "url" => "2-2.png"
        ]);
        Image::create([
            "product_id" => "3",
            "url" => "3-1.png"
        ]);
        Image::create([
            "product_id" => "4",
            "url" => "4-1.png"
        ]);
        Image::create([
            "product_id" => "4",
            "url" => "4-2.png"
        ]);
        Image::create([
            "product_id" => "5",
            "url" => "5-1.png"
        ]);
        Image::create([
            "product_id" => "6",
            "url" => "6-1.png"
        ]);
        Image::create([
            "product_id" => "7",
            "url" => "7-1.png"
        ]);
        Image::create([
            "product_id" => "8",
            "url" => "8-1.png"
        ]);
        Image::create([
            "product_id" => "9",
            "url" => "9-1.png"
        ]);
        Image::create([
            "product_id" => "10",
            "url" => "10-1.png"
        ]);
    }
}
