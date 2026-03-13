<!DOCTYPE html>
<html>
<head>
    <title>Liste des produits</title>
</head>
<body>
<h1>Liste des produits</h1>

@if($produits->isEmpty())
    <p>Aucun produit trouvé.</p>
@else
    <table border="1">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Stock</th>
            <th>Prix</th>
            <th>Description</th>
            <th>Classification</th>
        </tr>
        </thead>
        <tbody>
        @foreach($produits as $produit)
            <tr>
                <td>{{ $produit->nom }}</td>
                <td>{{ $produit->stock }}</td>
                <td>{{ $produit->prix }} €</td>
                <td>{{ $produit->description }}</td>
                <td>{{ $produit->classification }}</td>
                <a href={{ route('produits.edit', $produit->id) }} >Modifier</a>

            </tr>
        @endforeach
        </tbody>
    </table>
@endif
</body>
</html>
