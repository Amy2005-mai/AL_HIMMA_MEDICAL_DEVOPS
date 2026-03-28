<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'nom' => 'Paracetamol',
            'description' => 'Contre la douleur',
            'prix' => 500,
            'stock' => 100,
            'category_id' => 1
        ]);

        Product::create([
            'nom' => 'Thermomètre',
            'description' => 'Mesure la température',
            'prix' => 2000,
            'stock' => 50,
            'category_id' => 2
        ]);

        Product::create([
    'nom' => 'Tensiomètre',
    'description' => 'Mesure la pression artérielle',
    'prix' => 15000,
    'stock' => 20,
    'category_id' => 2
]);

Product::create([
    'nom' => 'Fauteuil roulant',
    'description' => 'Aide à la mobilité',
    'prix' => 80000,
    'stock' => 10,
    'category_id' => 2
]);

Product::create([
    'nom' => 'Oxymètre de pouls',
    'description' => 'Mesure le niveau d’oxygène dans le sang',
    'prix' => 12000,
    'stock' => 25,
    'category_id' => 2
]);

Product::create([
   'nom' => 'Masque chirurgical',
    'description' => 'Protection médicale',
    'prix' => 100,
    'stock' => 500,
    'category_id' => 2
]);

Product::create([
    'nom' => 'Gants médicaux',
    'description' => 'Protection hygiénique',
    'prix' => 200,
    'stock' => 300,
    'category_id' => 2
]);

Product::create([
    'nom' => 'Seringue',
    'description' => 'Injection médicale',
    'prix' => 150,
    'stock' => 200,
    'category_id' => 2
]);


}
}