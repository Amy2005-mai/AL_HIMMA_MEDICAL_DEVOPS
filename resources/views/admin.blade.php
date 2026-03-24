@extends('layouts.app')
@section('title', 'Tableau de bord Administrateur')
@section('content')

<div class="checkout-container" style="max-width: 1200px;">
    <div class="page-header">
        <h1 class="page-title">Gestion du Catalogue</h1>
        <p class="page-subtitle">Espace Administrateur - Ajoutez, modifiez ou supprimez vos équipements</p>
    </div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div style="margin-bottom: 2rem; display: flex; justify-content: space-between;">
        <a href="{{ url('/ajout') }}" class="checkout-btn" style="float: none; margin-top: 0; background: var(--primary-color);">+ Créer un nouvel équipement</a>
        <a href="{{ route('produits.lecture') }}" class="search-btn" style="text-decoration: none;">Voir la boutique (Client)</a>
    </div>

    <table class="premium-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Stock</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produits as $produit)
                <tr>
                    <td>#{{ $produit->id }}</td>
                    <td style="font-weight: 700;">{{ $produit->nom }}</td>
                    <td><span style="background: rgba(255, 255, 255, 0.1); padding: 0.3rem 0.8rem; border-radius: 8px; color: var(--primary-light); font-weight: 800;">{{ $produit->stock }}</span></td>
                    <td style="color: var(--primary-color); font-weight: 800;">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</td>
                    <td>{{ $produit->category->nom ?? 'Non classé' }}</td>
                    <td>
                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('produits.edit', $produit->id) }}" style="color: #3498db; text-decoration: none; font-weight: 600; padding: 0.5rem 1rem; border-radius: 50px; background: rgba(52, 152, 219, 0.1);">Modifier</a>
                            
                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer {{ $produit->nom }} ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: rgba(231, 76, 60, 0.1); border: none; color: #e74c3c; cursor: pointer; font-weight: 600; padding: 0.5rem 1rem; border-radius: 50px; transition: all 0.2s;">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
