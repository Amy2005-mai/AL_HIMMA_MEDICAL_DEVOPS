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
    }


    public function edit($id) { //affiche mais pour editer car met les valeurs de la bdd
        $produit= Produit::find($id) ;
        $ligne = Produit::select('classification')->distinct()->get();

        return view('form-edit-produit', compact('ligne','produit'));
       // $ligne= classification::all(); necessite une table Classification et donc un Modele
        //$ligne = Classification::orderBy('classification')->get(); //plus propre! necessite une table Classification

    }

    public function update(Request $request, $id)
    {            //$request->validate([
                //    'nom' => 'required',
                //    'prix' => 'required|numeric',
                //    'stock' => 'required|integer'
                //]);

            $produit = Produit::findOrFail($id);
            $produit -> update([
                'nom' => $request -> input(key: 'nom'),
                'prix' => $request -> prix,
                'stock' => $request -> stock,
                'description' => $request -> description,
                'classification' => $request -> classification
            ]);
            return redirect()->back();

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

}
