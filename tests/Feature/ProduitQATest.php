<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProduitQATest extends TestCase
{
    use RefreshDatabase; // Réinitialise la base à chaque test

    /**
     * 1. Tester l'affichage du produit (Catalogue)
     */
    public function test_affichage_catalogue_produit()
    {
        $response = $this->get('/produits');

        $response->assertStatus(200);
        $response->assertSee('Notre Catalogue Médical');
    }

    /**
     * 2. Tester l'ajout d'un produit (Valide)
     */
    public function test_ajout_produit_valide()
    {
        $category = Category::create([
            'nom' => 'Catégorie Test QA',
            'description' => 'Description test'
        ]);

        $response = $this->post('/save', [
            'nom' => 'Thermomètre Infrarouge',
            'prix' => 25000,
            'stock' => 15,
            'description' => 'Un thermomètre ultra rapide testé par Pape.',
            'classification' => $category->id,
        ]);

        $response->assertStatus(302); // redirection après succès

        $this->assertDatabaseHas('products', [
            'nom' => 'Thermomètre Infrarouge',
            'prix' => 25000,
            'stock' => 15
        ]);
    }

    /**
     * 3. Tester erreurs : Champs Vides
     */
    public function test_erreur_ajout_produit_champs_vides()
    {
        $response = $this->post('/save', []);

        $response->assertSessionHasErrors([
            'nom', 'prix', 'stock', 'description', 'classification'
        ]);
    }

    /**
     * 4. Tester erreurs : Prix négatif
     */
    public function test_erreur_ajout_produit_prix_negatif()
    {
        $category = Category::create([
            'nom' => 'Catégorie Erreur QA',
            'description' => 'Test erreur'
        ]);

        $response = $this->post('/save', [
            'nom' => 'Produit Erreur',
            'prix' => -500,
            'stock' => 10,
            'description' => 'Test prix négatif.',
            'classification' => $category->id,
        ]);

        $response->assertSessionHasErrors(['prix']);

        $this->assertDatabaseMissing('products', [
            'nom' => 'Produit Erreur'
        ]);
    }
}