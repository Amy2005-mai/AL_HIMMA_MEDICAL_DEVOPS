<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Médicaments',
            'description' => 'Produits pharmaceutiques'
        ]);

        Category::create([
            'name' => 'Matériel médical',
            'description' => 'Équipements médicaux'
        ]);
    }
}