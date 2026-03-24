@extends('layouts.app')
@section('title', 'Catalogue des équipements médicaux')
@section('content')

<div class="page-header">
    <h1 class="page-title">Notre Catalogue Médical</h1>
    <p class="page-subtitle">Découvrez notre gamme d'équipements de haute qualité</p>
</div>

<div class="search-container">
    <form method="GET" action="{{ route('produits.recherche') }}" class="search-form">
        <input type="text" name="motcle" class="search-input" placeholder="Rechercher un équipement, une description..." value="{{ $motcle ?? '' }}">
        <button type="submit" class="search-btn">Rechercher</button>
        @if(isset($motcle) && $motcle !== '')
            <a href="{{ route('produits.lecture') }}" style="display: flex; align-items: center; padding: 0 1rem; color: var(--text-muted); text-decoration: none; font-weight: bold;">✕</a>
        @endif
    </form>
</div>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

@if($produits->isEmpty())
    <div style="text-align: center; color: var(--text-muted); padding: 4rem;">
        <h3>Aucun équipement ne correspond à votre recherche.</h3>
    </div>
@else
    <div class="products-grid">
        @foreach($produits as $produit)
            <div class="product-card">
                <span class="product-badge">{{ $produit->category->nom ?? 'Standard' }}</span>
                <h2 class="product-title">{{ $produit->nom }}</h2>
                <div class="product-price">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</div>
                <div class="product-stock">
                    <span style="display: inline-block; width: 8px; height: 8px; background: var(--accent-color); border-radius: 50%;"></span>
                    En stock ({{ $produit->stock }})
                </div>
                <p class="product-desc">{{ strlen($produit->description) > 120 ? substr($produit->description, 0, 120) . '...' : $produit->description }}</p>
                
                <form action="{{ route('ajoutPanier', $produit->id) }}" method="POST" class="add-to-cart-form">
                    @csrf
                    <input type="number" name="quantite" value="1" min="1" max="{{ $produit->stock }}" class="qty-input">
                    <button type="submit" class="btn-add-cart">Ajouter au panier</button>
                </form>
            </div>
        @endforeach
    </div>
@endif

@endsection
