<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rayon;

class RayonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() {
        Rayon::create(['name' => 'Fruits and Vegetables', 'description' => '...']);
        Rayon::create(['name' => 'Electronic', 'description' => '...']);
    }
}
