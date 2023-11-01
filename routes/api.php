<?php

use App\Http\Controllers\PaisController;
use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/paises', [PaisController::class, 'index']);
Route::get('/clientes', [ClienteController::class, 'index']);
Route::post('/cliente/store', [ClienteController::class, 'store']);
Route::put('/cliente/update/{id}', [ClienteController::class, 'update']);
Route::delete('/cliente/delete/{id}', [ClienteController::class, 'delete']);
Route::get('/cliente/find/{id}', 'App\Http\Controllers\ClienteController@find');
Route::get('/cliente/find2/{id}', 'App\Http\Controllers\ClienteController@find2');

