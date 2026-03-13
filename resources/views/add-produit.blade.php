@extends('layouts.app')

@section('title', 'Ajouter un Produit')

@section('content')
<div class="auth-container">
    <div class="auth-form-container">
        <h2 class="auth-title">Ajouter un produit</h2>

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

        <form action="/save" method="POST" class="auth-form">
            @csrf
            <div class="form-group">
                <label class="form-label">Nom du produit</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required class="form-input" placeholder="Saisir le nom">
                @error('nom') <span style="color: #ffbaba; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock') }}" min="0" required class="form-input" placeholder="Chiffre en stock">
                @error('stock') <span style="color: #ffbaba; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Prix (€)</label>
                <input type="number" name="prix" id="prix" value="{{ old('prix') }}" min="0" required class="form-input" placeholder="Prix en €">
                @error('prix') <span style="color: #ffbaba; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" id="descri" cols="30" rows="5" required class="form-input-textarea" placeholder="Description du produit">{{ old('description') }}</textarea>
                @error('description') <span style="color: #ffbaba; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="classification" class="form-label">Classification</label>
                <select name="classification" id="classification" class="form-input">
                    <option value="" selected disabled hidden>Choisir une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('classification') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('classification') <span style="color: #ffbaba; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="auth-button">Ajouter</button>
        </form>
    </div>
</div>
@endsection

 