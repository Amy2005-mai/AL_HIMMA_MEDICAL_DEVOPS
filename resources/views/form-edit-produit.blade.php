@extends('layouts.app')

@section('title', 'Editer un produit')

@section('content')
<div class="auth-container">
    <div class="auth-form-container">
        <h2 class="auth-title">Editer un produit</h2>

        @if(session('success'))
            <div style="color: green; margin-bottom: 1rem;">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div style="color: red; margin-bottom: 1rem;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('produits.update', $produit->id) }}" method="POST" class="auth-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Nom du produit</label>
                <input type="text" name="nom" id="nom" required class="form-input" value="{{ old('nom', $produit->nom) }}">
                @error('nom') <span style="color: #ffbaba; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" required class="form-input" value="{{ old('stock', $produit->stock) }}" min="0">
                @error('stock') <span style="color: #ffbaba; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Prix (€)</label>
                <input type="number" name="prix" id="prix" required class="form-input" value="{{ old('prix', $produit->prix) }}" min="0">
                @error('prix') <span style="color: #ffbaba; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" id="descri" cols="30" rows="5" required class="form-input-textarea"
                 >{{ old('description', $produit->description) }}</textarea>
                @error('description') <span style="color: #ffbaba; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="classification" class="form-label">Classification</label>
                <select name="classification" id="classification" class="form-input">
                    <option value="" disabled>Choisir une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('classification', $produit->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('classification') <span style="color: #ffbaba; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="auth-button">Editer</button>
        </form>
    </div>
</div>
@endsection

