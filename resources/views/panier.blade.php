@extends('layouts.app')
@section('title', 'Votre Panier')
@section('content')

<div class="checkout-container">
    <div class="page-header">
        <h1 class="page-title">Votre Panier</h1>
        <p class="page-subtitle">Vérifiez vos articles avant de finaliser l'achat</p>
    </div>

    @if(session('error'))
        <p style="color:#e74c3c; text-align:center; font-weight:bold; margin-bottom: 2rem;">{{ session('error') }}</p>
    @endif
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($panier))
        <div style="text-align: center; padding: 4rem; background: var(--bg-card); border-radius: var(--border-radius); box-shadow: var(--shadow-soft);">
            <h3 style="color: var(--text-muted);">Votre panier est actuellement vide.</h3>
            <br>
            <a href="{{ route('produits.lecture') }}" class="search-btn" style="text-decoration: none; display: inline-block; margin-top: 1rem;">Retourner au catalogue</a>
        </div>
    @else
        <table class="premium-table">
            <thead>
                <tr>
                    <th>Désignation de l'équipement</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th style="width: 50px;"></th>
                </tr>
            </thead>
            <tbody>
                @php $totalGeneral = 0; @endphp
                @foreach($panier as $id => $item)
                    @php $totalItem = $item['prix'] * $item['quantite']; $totalGeneral += $totalItem; @endphp
                    <tr>
                        <td style="font-weight: 700;">{{ $item['nom'] }}</td>
                        <td>{{ number_format($item['prix'], 0, ',', ' ') }} FCFA</td>
                        <td>
                            <span style="background: rgba(255, 255, 255, 0.1); padding: 0.4rem 0.8rem; border-radius: 8px; color: var(--primary-light); font-weight: 800;">
                                {{ $item['quantite'] }}
                            </span>
                        </td>
                        <td style="color: var(--primary-color); font-weight: 800;">{{ number_format($totalItem, 0, ',', ' ') }} FCFA</td>
                        <td>
                            <form action="{{ route('retraitPanier', $id) }}" method="POST">
                                @csrf
                                <button type="submit" style="background: none; border: none; color: #e74c3c; cursor: pointer; font-size: 1.2rem; padding: 0.2rem; transition: transform 0.2s;" title="Retirer du panier" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">✖</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: 700; font-size: 1.2rem; padding-right: 2rem;">Total Général :</td>
                    <td colspan="2" style="font-weight: 800; font-size: 1.4rem; color: var(--primary-color);">{{ number_format($totalGeneral, 0, ',', ' ') }} FCFA</td>
                </tr>
            </tfoot>
        </table>

        <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--shadow-soft); margin-top: 2rem;">
            <h3 style="margin-top: 0; color: var(--text-main); margin-bottom: 1.5rem;">Informations de livraison</h3>
            <form action="{{ route('commander') }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem; max-width: 500px;">
                @csrf
                <div class="form-group">
                    <label for="customer_name" class="form-label">Nom complet *</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-input" required placeholder="Ex: papiico gaye">
                </div>
                <div class="form-group">
                    <label for="customer_phone" class="form-label">Numéro de téléphone *</label>
                    <input type="tel" name="customer_phone" id="customer_phone" class="form-input" required placeholder="Ex: 77 330 67 85">
                </div>
                <button type="submit" class="checkout-btn" style="align-self: flex-start; margin-top: 1rem;">Finaliser la commande →</button>
            </form>
        </div>
    @endif
</div>
@endsection
