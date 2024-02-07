<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\RarityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

//login and register
Route::get('loginPage', [AuthController::class, 'login'])->name('auth#loginPage');
Route::get('registerPage', [AuthController::class, 'register'])->name('auth#registerPage');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    //pokemon home page
    Route::get('homePage', [PokemonController::class, 'home'])->name('pokemon#home');
    //filter
    Route::get('filter/{id}', [PokemonController::class, 'filter'])->name('pokemon#filter');

    //pokemon create page
    Route::get('pokemon/createPage', [PokemonController::class, 'createPage'])->name('pokemon#createPage');

    //pokemon CRUD
    Route::post('pokemon/create', [PokemonController::class, 'create'])->name('pokemon#create');
    Route::get('pokemon/delete/{id}', [PokemonController::class, 'delete'])->name('pokemon#delete');
    Route::get('pokemon/edit/{id}', [PokemonController::class, 'editPage'])->name('pokemon#edit');
    Route::post('pokemon/update/{id}', [PokemonController::class, 'update'])->name('pokemon#update');

    //rarity
    Route::get('rarity/page', [RarityController::class, 'rarityPage'])->name('rarity#homePage');
    Route::post('rarity/create', [RarityController::class, 'create'])->name('rarity#create');

    //ajax
    Route::get('pokemon/list', [AjaxController::class, 'myList'])->name('ajax#list');

});
