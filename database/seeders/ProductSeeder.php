<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
        Product::create([
            'name' => 'Pomme',
            'price' => 1.99,
            'quantity' => 100,
            'rayon_id' => 1,
            'category' => 'Fruits',
        ]);
    }
}
