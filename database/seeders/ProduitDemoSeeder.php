<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProduitDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c1 = Category::where('nom', 'like', '%Diagnostic%')->firstOrFail()->id;
        $c2 = Category::where('nom', 'like', '%Consommables%')->firstOrFail()->id;
        $c3 = Category::where('nom', 'like', '%Mobilite%')->firstOrFail()->id;
        $c4 = Category::where('nom', 'like', '%Urgences%')->firstOrFail()->id;
        $c5 = Category::where('nom', 'like', '%Mobilier%')->firstOrFail()->id;

        $produits = [
            // 1: Appareils de Diagnostic
            ['nom' => 'Tensiomètre Électronique au Bras', 'description' => 'Appareil médical professionnel pour la prise de tension artérielle. Précision clinique, écran LCD.', 'prix' => 25000, 'stock' => 50, 'category_id' => $c1],
            ['nom' => 'Thermomètre Infrarouge Frontal', 'description' => 'Mesure sans contact ultrarapide, idéal pour pédiatrie et urgences. Affichage couleur.', 'prix' => 15000, 'stock' => 120, 'category_id' => $c1],
            ['nom' => 'Stéthoscope Littmann Classic III', 'description' => 'La référence des médecins. Haute sensibilité acoustique, tubulure résistante.', 'prix' => 65000, 'stock' => 15, 'category_id' => $c1],

            // 2: Consommables Medicaux
            ['nom' => 'Boîte de 100 Gants Nitrile Stériles', 'description' => 'Gants d\'examen sans poudre, haute résistance aux déchirures. Taille L.', 'prix' => 4500, 'stock' => 200, 'category_id' => $c2],
            ['nom' => 'Lot de 50 Masques Chirurgicaux', 'description' => 'Masques médicaux Type IIR, filtration bactérienne à 98% (BFE).', 'prix' => 3000, 'stock' => 500, 'category_id' => $c2],
            ['nom' => 'Compresses de Gaze Stériles (10x10)', 'description' => 'Sachet de compresses très absorbantes pour le soin des plaies. 100 unités.', 'prix' => 1500, 'stock' => 300, 'category_id' => $c2],

            // 3: Mobilité & Maintien
            ['nom' => 'Fauteuil Roulant Manuel Standard', 'description' => 'Fauteuil pliant robuste en acier, accoudoirs escamotables, freins tiers.', 'prix' => 85000, 'stock' => 8, 'category_id' => $c3],
            ['nom' => 'Déambulateur Rollator à 4 Roues', 'description' => 'Assistance à la marche sécurisée, muni d\'un panier et de freins anatomiques.', 'prix' => 32000, 'stock' => 12, 'category_id' => $c3],

            // 4: Urgences & Secours
            ['nom' => 'Défibrillateur Automatique (DSA)', 'description' => 'Appareil de sauvetage cardiaque grand public avec assistance vocale. Sauvez une vie.', 'prix' => 650000, 'stock' => 2, 'category_id' => $c4],
            ['nom' => 'Trousse de Premiers Secours Pro', 'description' => 'Kit d\'urgence complet comprenant ciseaux de gesco, pansements, antiseptiques, couverture de survie.', 'prix' => 18000, 'stock' => 25, 'category_id' => $c4],

            // 5: Mobilier Médical
            ['nom' => 'Table d\'Examen Électrique', 'description' => 'Table de consultation médicale avec dossier réglable électriquement. Simili cuir lavable.', 'prix' => 350000, 'stock' => 3, 'category_id' => $c5],
            ['nom' => 'Paravent Médical 3 Panneaux', 'description' => 'Paravent sur roulettes pour l\'intimité des patients. Structure tubulaire solide.', 'prix' => 45000, 'stock' => 6, 'category_id' => $c5],
        ];

        foreach ($produits as $produit) {
            Product::create($produit);
        }
    }
}
