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