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

        Product::create([
    'name' => 'Tensiomètre',
    'description' => 'Mesure la pression artérielle',
    'price' => 15000,
    'stock' => 20,
    'category_id' => 2
]);

Product::create([
    'name' => 'Fauteuil roulant',
    'description' => 'Aide à la mobilité',
    'price' => 80000,
    'stock' => 10,
    'category_id' => 2
]);

Product::create([
    'name' => 'Oxymètre de pouls',
    'description' => 'Mesure le niveau d’oxygène dans le sang',
    'price' => 12000,
    'stock' => 25,
    'category_id' => 2
]);

Product::create([
    'name' => 'Masque chirurgical',
    'description' => 'Protection médicale',
    'price' => 100,
    'stock' => 500,
    'category_id' => 2
]);

Product::create([
    'name' => 'Gants médicaux',
    'description' => 'Protection hygiénique',
    'price' => 200,
    'stock' => 300,
    'category_id' => 2
]);

Product::create([
    'name' => 'Seringue',
    'description' => 'Injection médicale',
    'price' => 150,
    'stock' => 200,
    'category_id' => 2
]);
    }

}