<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//create rarity
Route::post('rarity/create', [ApiController::class, 'rarityCreate']); //http://127.0.0.1:8000/api/rarity/create(post)
// body{
//    'name' = ''
// }

//pokemon rarity list
Route::get('rarity/list', [ApiController::class, 'rarityList']); //http://127.0.0.1:8000/api/rarity/list (get)

//delete rarity
Route::get('rarity/delete/{id}', [ApiController::class, 'rarityDelete']); //http://127.0.0.1:8000/api/rarity/delete/{id} (get)

//detail rarity
Route::post('rarity/detail', [ApiController::class, 'rarityDetail']); //http://127.0.0.1:8000/api/rarity/detail (post)
// body {
//     'id' = ''
// }

//update rarity
Route::post('rarity/update', [ApiController::class, 'rarityUpdate']); //http://127.0.0.1:8000/api/rarity/update (post)
// body {
//     'id' = '',
//     'name' = '',
// }

//create pokemon
Route::post('pokemon/create', [ApiController::class, 'pokemonCreate']); //http://127.0.0.1:8000/api/pokemon/create (post)
// body {
//     'name' = '',
//     'rarity' ='',
//     'image' ='',
//     'price' ='',
//     'qty' ='',
// }

// pokemon list
Route::get('pokemon/list', [ApiController::class, 'pokemonList']); //http://127.0.0.1:8000/api/pokemon/list (get)

//delete pokemon
Route::get('pokemon/delete/{id}', [ApiController::class, 'pokemonDelete']); //http://127.0.0.1:8000/api/pokemon/delete/{id} (get)

//detail pokemon
Route::post('pokemon/detail', [ApiController::class, 'pokemonDetail']); //http://127.0.0.1:8000/api/pokemon/detail (get)
//body {
//     'id' = ''
// }

//update pokemon
Route::post('pokemon/update', [ApiController::class, 'pokemonUpdate']); //http://127.0.0.1:8000/api/pokemon/update (post)
// body {
//      'id' = ''
//     'name' = '',
//     'rarity' ='',
//     'image' ='',
//     'price' ='',
//     'qty' ='',
// }

//pokemon filter
Route::post('pokemon/filter', [ApiController::class, 'filterPokemon']); //http://127.0.0.1:8000/api/pokemon/filter (post)
// body{
//     'rarity' = ''
// }

//pokemon search
Route::post('pokemon/search', [ApiController::class, 'searchPokemon']); //http://127.0.0.1:8000/api/pokemon/search (post)
// body{
//     'keyword' = ''
// }
