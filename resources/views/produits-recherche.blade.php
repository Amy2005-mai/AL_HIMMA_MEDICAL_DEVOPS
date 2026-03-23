<!DOCTYPE html>
<html>
<head>
    <title>Liste des produits</title>
</head>
<body>
<h1>Liste des produits + Recherche + Ajouter au panier</h1>
<pre>
DEBUG session:
{{ print_r(session()->all()) }}
</pre>

<a href="/ajout">Ajouter un produit</a>
<form method="GET" action="{{ route('produits.recherche') }}">
    <input type="text" name="motcle" placeholder="Rechercher un produit" value="{{ request('motcle') }}">
    <button type="submit">Rechercher</button>
</form>
@if($produits->isEmpty())
    <p>Aucun produit trouvé.</p>
@else
    <table border="1">
        <thead>
        <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Stock</th>
            <th>Prix</th>
            <th>Description</th>
            <th>Classification</th>
            <th>Actions</th>
            <!-- <th>Options2 oui</th>
            <th>Options3 non</th> -->
        </tr>
        </thead>
        <tbody>
        @foreach($produits as $produit)
            <tr>
                <td>{{ $produit->id }}</td>
                <td>{{ $produit->nom }}</td>
                <td>{{ $produit->stock }}</td>
                <td>{{ $produit->prix }} €</td>
                <td>{{ $produit->description }}</td>
                <td>{{ $produit->classification }}</td>
                <td>
                <form action="{{ route('ajoutPanier', $produit->id) }}" method="POST">
                    @csrf
                    <input type="number" name="quantite" min="1" max="{{ $produit->stock }}" value="1">
                    <button type="submit">Ajouter au panier</button>

                </form>
                <!-- si tu ajoute le panier ce message s'affiche: produit ajouté au panier -->

                </td>
              <!--  <td> <a href= { { route('produits.edit') }} >Modifier</a> </td>
                <td> <a href={ { route('produits.editId', $produit-> id) }} >Modifier2</a> </td>
                <td> <a href={ { route('produits.delete', $produit-> id) }} >Supprimer</a> </td> -->
               <!-- <form action="{ { route('produits.destroy', $produit->id) }}" method="POST" style="display:inline;">
                    @ csrf
                    @ method('DELETE')
                    <button type="submit">Supprimer</button>
                </form> -->
            </tr>
           <!-- <button type="submit" onclick="{ { route('produits.destroy', $produit-> id) }}">Supprimer</button>
            <a href={ { route('produits.delete', $produit-> id) }} >Modifier3</a> -->
        @endforeach
        </tbody>
    </table>
@endif
<a href={{ route('checkout')}} >Voir mon panier</a>
 <!-- message qd le produit est ajoute: produit a étè ajouté -->
@if(session('success'))
    <div style="color: green; font-weight:bold; text-align: center" >
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif
<!-- <a href={ { route('produits.delete', $produit-> id) }} >Modifier3</a> -->
</body>
</html>

