<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'nom' => 'Médicaments',
            'description' => 'Produits pharmaceutiques'
        ]);

        Category::create([
            'nom' => 'Matériel médical',
            'description' => 'Équipements médicaux'
        ]);
    }
}