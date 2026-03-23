<?php

use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/ajout', \App\Http\Controllers\ProduitController::class . '@index');
Route::get('/produits/{id}/edit', [\App\Http\Controllers\ProduitController::class, 'editId'])
    ->name('produits.editId');
Route::get('/produitEdit', [\App\Http\Controllers\ProduitController::class, 'edit'])
   ->name('produits.edit');
Route::post('/save', \App\Http\Controllers\ProduitController::class . '@store');
Route::put('/produits/{id}', [\App\Http\Controllers\ProduitController::class , 'update'])->name('produits.update');
Route::get('/produits', [\App\Http\Controllers\ProduitController::class, 'lecture'])->name('produits.lecture');
Route::delete('/produits/{id}', [\App\Http\Controllers\ProduitController::class, 'destroy'])->name('produits.destroy');
Route::get('/produits/{id}/delete', [\App\Http\Controllers\ProduitController::class, 'destroy'])->name('produits.delete');

Route::get('/produits/recherche', [\App\Http\Controllers\ProduitController::class, 'search'])->name('produits.recherche');
Route::post('/ajoutPanier/{id}',ProduitController::class . '@ajoutPanier')->name('ajoutPanier');
Route::get('/affichePanierCheck', [\App\Http\Controllers\ProduitController::class, 'checkout'])->name('checkout');
Route::post('/Commander', [\App\Http\Controllers\ProduitController::class, 'commander'])->name('commander');

Route::get('/validCommande', [\App\Http\Controllers\ProduitController::class, 'afficheValidCommande'])->name('validCommand');


#Accès au formulaire → /produits/2/edit (GET) à n'mporte quel formulaire ou methode ex: /produits/{id}/delete
//Soumission → /produits/2 (PUT)