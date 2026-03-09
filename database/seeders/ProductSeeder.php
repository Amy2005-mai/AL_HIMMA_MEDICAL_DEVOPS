<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Paracetamol',
            'description' => 'Contre la douleur',
            'price' => 500,
            'stock' => 100,
            'category_id' => 1
        ]);

        Product::create([
            'name' => 'Thermomètre',
            'description' => 'Mesure la température',
            'price' => 2000,
            'stock' => 50,
            'category_id' => 2
        ]);
    }
}