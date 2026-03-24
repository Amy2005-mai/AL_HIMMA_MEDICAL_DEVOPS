<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $produit = Product::findOrFail($id);
        $quantite = $request->input('quantite', 1);

        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            $panier[$id]['quantite'] += $quantite;
        } else {
            $panier[$id] = [
                "nom" => $produit->nom,
                "quantite" => $quantite,
                "prix" => $produit->prix,
                "id" => $id
            ];
        }

        session()->put('panier', $panier);
        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    public function index()
    {
        $panier = session()->get('panier', []);
        return view('panier', compact('panier'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:255',
        ]);

        $panier = session()->get('panier', []);

        if (empty($panier)) {
            return redirect()->route('produits.lecture')->with('error', 'Votre panier est vide.');
        }

        $totalPrice = 0;
        foreach ($panier as $item) {
            $totalPrice += $item['prix'] * $item['quantite'];
        }

        $order = \App\Models\Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'total_price' => $totalPrice,
            'user_id' => auth()->id(),
        ]);

        foreach ($panier as $id => $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantite'],
                'price' => $item['prix'],
            ]);

            // Déduction du stock
            $product = \App\Models\Product::find($id);
            if ($product) {
                // On s'assure que le stock ne devient pas négatif
                $newStock = max(0, $product->stock - $item['quantite']);
                $product->update(['stock' => $newStock]);
            }
        }

        session()->forget('panier');
        return redirect()->route('produits.lecture')->with('success', 'Commande validée avec succès pour ' . $request->customer_name . ' !');
    }

    public function remove($id)
    {
        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            unset($panier[$id]);
            session()->put('panier', $panier);
        }

        return redirect()->back()->with('success', 'Produit retiré du panier.');
    }
}
