@extends('layouts.app')

@section('title', 'Liste des produits')

@section('content')
<div class="table-container">
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
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($produits as $produit)
            <tr>
                <td>{{ $produit->nom }}</td>
                <td>{{ $produit->stock }}</td>
                <td>{{ $produit->prix }} €</td>
                <td>{{ $produit->description }}</td>
                <td>{{ $produit->category->name ?? 'Non classé' }}</td>
                    <td>
                        <a href="{{ route('produits.edit', $produit->id) }}" style="color: #3498db; text-decoration: none; font-weight: bold;">Modifier</a>
                    </td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endif
</body>
</html>