<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/ajout', \App\Http\Controllers\ProduitController::class . '@index');
Route::get('/produits/{id}/edit', [\App\Http\Controllers\ProduitController::class, 'edit'])
    ->name('produits.edit');
Route::post('/save', \App\Http\Controllers\ProduitController::class . '@store');
Route::put('/produits/{id}', [\App\Http\Controllers\ProduitController::class , 'update'])->name('produits.update');
Route::get('/produits', [\App\Http\Controllers\ProduitController::class, 'lecture'])->name('produits.lecture');
Route::get('/produits/recherche', [\App\Http\Controllers\ProduitController::class, 'recherche'])->name('produits.recherche');
Route::delete('/produits/{id}', [\App\Http\Controllers\ProduitController::class, 'destroy'])->name('produits.destroy');

Route::get('/admin', [\App\Http\Controllers\ProduitController::class, 'adminIndex'])->name('admin.index');

Route::post('/panier/ajouter/{id}', [\App\Http\Controllers\CartController::class, 'add'])->name('ajoutPanier');
Route::post('/panier/retirer/{id}', [\App\Http\Controllers\CartController::class, 'remove'])->name('retraitPanier');
Route::get('/panier', [\App\Http\Controllers\CartController::class, 'index'])->name('checkout');
Route::post('/panier/commander', [\App\Http\Controllers\CartController::class, 'checkout'])->name('commander');

Route::get('/produits', [ProduitController::class, 'lecture'])->name('produits.lecture');
Route::post('/save', [ProduitController::class, 'store'])->name('produits.save');