<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();
        return view('add-produit', compact('categories'));
    }

    public function adminIndex()
    {
        $produits = Product::with('category')->get();
        return view('admin', compact('produits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'classification' => 'required|exists:categories,id',
        ]);

        Product::create([
            'nom' => $request->input('nom'),
            'prix' => $request->input('prix'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
            'category_id' => $request->input('classification'),
        ]);

        return redirect()->back()->with('success', 'Produit ajouté avec succès !');
    }


    public function edit($id)
    { //affiche mais pour editer car met les valeurs de la bdd
        $produit = Product::findOrFail($id);
        $categories = Category::all();

        return view('form-edit-produit', compact('categories', 'produit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'classification' => 'required|exists:categories,id',
        ]);

        $produit = Product::findOrFail($id);
        $produit->update([
            'nom' => $request->input('nom'),
            'prix' => $request->input('prix'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
            'category_id' => $request->input('classification')
        ]);

        return redirect()->back()->with('success', 'Produit mis à jour avec succès !');
    }

    //  $employer = Employer::findOrFail($id); ces 3 necessite de definir $filiable car entre donne massive!
    //  $employer->update($request->all());
    public function lecture()
    {
        // Lire tous les produits avec leur catégorie
        $produits = Product::with('category')->get();

        // Envoyer à la vue
        return view('produits', compact('produits'));
    }

    public function recherche(Request $request)
    {
        $motcle = $request->input('motcle');
        $produits = Product::with('category')
            ->where('nom', 'LIKE', "%{$motcle}%")
            ->orWhere('description', 'LIKE', "%{$motcle}%")
            ->get();

        return view('produits', compact('produits', 'motcle'));
    }

    public function destroy($id)
    {
        $produit = Product::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.lecture')->with('success', 'Produit supprimé avec succès !');
    }
}
