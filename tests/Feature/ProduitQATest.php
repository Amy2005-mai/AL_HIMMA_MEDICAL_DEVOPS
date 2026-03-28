<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProduitQATest extends TestCase
{
    use RefreshDatabase;
    /**
     * Utilisation de DatabaseTransactions :
     * Toutes les modifications faites dans ce fichier de test
     * seront annulées à la fin. La base de données de l'équipe
     * restera intacte (Ehbib sera content !).
     */
    use DatabaseTransactions;

    /**
     * 1. Tester l'affichage du produit (Catalogue)
     */
    public function test_affichage_catalogue_produit()
    {
        $response = $this->get('/produits');
        
        // S'assurer que la page charge sans erreur (200 OK)
        $response->assertStatus(200);
        // S'assurer qu'on affiche bien le catalogue
        $response->assertSee('Notre Catalogue Médical');
    }

    /**
     * 2. Tester l'ajout d'un produit (Valide)
     */
    public function test_ajout_produit_valide()
    {
        // Créer une fausse catégorie pour le test
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

        // Vérifier que ça redirige après succès sans crash
        $response->assertStatus(302);
        
        // Vérifier que le produit est BIEN dans la base de données
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
        // On n'envoie aucune donnée au formulaire de création
        $response = $this->post('/save', []);

        // Ça doit renvoyer des erreurs de validation (statut 302 avec erreurs en session)
        $response->assertSessionHasErrors(['nom', 'prix', 'stock', 'description', 'classification']);
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

        // On envoie un prix invalide (-500)
        $response = $this->post('/save', [
            'nom' => 'Produit Erreur',
            'prix' => -500, // ERREUR ICI
            'stock' => 10,
            'description' => 'Test prix negatif.',
            'classification' => $category->id,
        ]);

        // S'assurer que Laravel a bloqué et renvoyé une erreur spécifiquement pour 'prix'
        $response->assertSessionHasErrors(['prix']);
        
        // Et s'assurer que ça N'EST PAS dans la base de données !
        $this->assertDatabaseMissing('products', [
            'nom' => 'Produit Erreur'
        ]);
    }
}
