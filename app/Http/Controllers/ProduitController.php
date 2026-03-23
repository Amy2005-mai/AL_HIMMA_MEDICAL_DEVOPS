<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    //
    public function index()
    {
        return view('add-produit');
    }

    public function store(Request $request){ // c'est saveProduit : insertion

                $produit = new Produit();
                $produit -> nom= $request-> input(key: 'nom');
                $produit -> prix = $request-> input(key: 'prix');
                $produit -> stock = $request-> input(key: 'stock');
                $produit -> description = $request-> input(key: 'description');
                $produit -> classification = $request-> input(key: 'classification');
                $produit -> save();

        return redirect()->back();
                                                //        return response()->json([
                                                //            "message" => "Etudiant enregistré",
                                                //            "data" => $produit,
                                                //        ]);
    }
// Sur un click : bouton ou link a , car on recupére id et c'est une route get qui est en commentaire sur web.php
    public function editId($id) { //affiche mais pour editer car prend les valeurs de la bdd
        $produit= Produit::find($id) ;
        $ligne = Produit::select('classification')->distinct()->get();

        return view('form-edit-produit', compact('ligne','produit'));
       // $ligne= classification::all(); necessite une table Classification et donc un Modele
        //$ligne = Classification::orderBy('classification')->get(); //plus propre! necessite une table Classification

   }
    public function edit() { //affiche mais pour editer car prend les valeurs de la bdd
        $produit= Produit::all();
        $ligne = Produit::select('classification')->distinct()->get();
        // Liste simulée de produits
        //        $produit = [
        //            ['id'=>1,'nom'=>'Produit A','stock'=>50,'prix'=>100,'description'=>'Desc A','classification'=>'I'],
        //            ['id'=>2,'nom'=>'Produit B','stock'=>30,'prix'=>200,'description'=>'Desc B','classification'=>'IIa'],
        //            ['id'=>3,'nom'=>'Produit C','stock'=>70,'prix'=>150,'description'=>'Desc C','classification'=>'IIb'],
        //        ];

        return view('form-edit-produit', compact( 'ligne','produit'));

    }

    public function update(Request $request, $id)
    {            //$request->validate([
                //    'nom' => 'required',
                //    'prix' => 'required|numeric',
                //    'stock' => 'required|integer'
                //]);

            $produit = Produit::findOrFail($id); // ← renvoie une Collection de tous les utilisateurs
            $produit -> update([
                'nom' => $request -> input(key: 'nom'),
                'prix' => $request -> prix,
                'stock' => $request -> stock,
                'description' => $request -> description,
                'classification' => $request -> classification
            ]);
            return redirect()->back();
                                // Produit simulé avant update
                        //        $produit = [
                        //            'id' => $id,
                        //            'nom' => 'Produit original',
                        //            'stock' => 50,
                        //            'prix' => 300,
                        //            'description' => 'Description initiale',
                        //            'classification' => 'IIa'
                        //        ];

                                // Mise à jour des valeurs envoyées
                        //        foreach ($request->all() as $key => $value) {
                        //            if (isset($produit[$key])) {
                        //                $produit[$key] = $value;
                        //            } }
            // return response()->json([  ici c pour enregistrer un etudiant pas ca place ici pr aucune methode
            //     "message" => "Etudiant enregistré",
            //     "data" => $produit,
            //     ]);
    //  $employer = Employer::findOrFail($id); ces 3 necessite de definir $filiable car entre donne massive!
    //  $employer->update($request->all());
    //  return redirect()->back();

    }
    public function lecture()
    {
        // Lire tous les produits
        $produits = Produit::all();

        // Envoyer à la vue
        return view('produits', compact('produits'));
    }

    public function destroy($id){ // delete
        Produit::destroy($id);
        return redirect()->back();
    }
    public function search(Request $request){
//        $motcle = $request->motcle;  ceci bien plus propre en bas
//        $produits = Produit::where('nom', 'like', '%' . $motcle . '%')->get();
//        return view('produits.index', compact('produits'));
       // $produits = Produit::where('id', $request->motcle)->get(); ici c avec l'id qu'on f la recherche
//        $produits = Produit::when($request->motcle, function ($query) use ($request) {
//            $query->where('nom', 'like', '%' . $request->motcle . '%');
//        })->get();

        if ($request->motcle) {
            $produits = Produit::when($request->motcle, function ($query) use ($request) {
                $query->where('nom', 'like', '%' . $request->motcle . '%');
            })->get();
            //$produits = Produit::where('nom', 'like', '%' . $request->motcle . '%')->get();
        } else {
            $produits = Produit::all();
        }
        return view('produits-recherche', compact('produits'));
    }

    //Partie panier--------------------------------------------
    public function ajoutPanier(Request $request, $id){
        $request->validate([
            'quantite' => 'required|integer|min:1'
        ]);

        $produit = Produit::findOrFail($id);

        $quantiteDemande = $request->input('quantite');

        // Vérifier le stock
        if ($produit->stock < $quantiteDemande) {
            return redirect()->back()->with('error', 'Stock insuffisant pour ' . $produit->nom);
        }

        // Récupérer ou créer le panier
        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            // Vérifier si la somme de l'ancienne quantité et nouvelle ne dépasse pas le stock
            if ($panier[$id]['quantite'] + $quantiteDemande > $produit->stock) {
                return redirect()->back()->with('error', 'Stock insuffisant pour ajouter cette quantité de ' . $produit->nom);
            }
            $panier[$id]['quantite'] += $quantiteDemande;
        } else {
            $panier[$id] = [
                'nom' => $produit->nom,
                'prix' => $produit->prix,
                'quantite' => $quantiteDemande
            ];
        }

        // Sauvegarder le panier
        session()->put('panier', $panier);

        return redirect()->back()->with('success','Produit "'.$produit->nom.'" ajouté au panier');
    }

    // Afficher le panier
    public function Panier()
    {
        $panier = session()->get('panier', []);
        return view('panier', compact('panier'));
    }
    //fin partie panier -----------------------------------------------------

    //partie controller Commande---------------------------------------
    // Afficher le panier avant checkout, on pouver ne pas le mettre et prendre Panier car ce le mm, sinon on le renomme
    public function checkout()
    {
        $panier = session()->get('panier', []);
        return view('panier', compact('panier'));
    }

    // Valider la commande et mettre à jour le stock
    public function commander()
    {
        $panier = session()->get('panier', []);

        foreach ($panier as $id => $item) {
            $produit = Produit::findOrFail($id);
                //la verification a étè déjà fait lors de l'ajtPAnier mais tu p l refaire ici ou non
            if ($produit->stock < $item['quantite']) {
                return redirect()->back()->with('error','Stock insuffisant pour '.$produit->nom);
            }

            // Mise à jour du stock
            $produit->stock -= $item['quantite'];
            $produit->save();
        }

        // Vider le panier
        session()->forget('panier');

        return redirect()->route('checkout')->with('success','Commande effectuée avec succès');
      //  return redirect()->route('validCommand')->with('success','Commande effectuée avec succès'); ici si sans le msg succes car il va à recherche

    }


    public function afficheValidCommande()
    {   $panier = session()->get('panier', []);
        return view('validerCommande', compact('panier'));
    }

#
}
