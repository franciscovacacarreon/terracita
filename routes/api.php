<?php

use App\Http\Controllers\ItemMenuController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuItemMenuController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\TipoMenuController;
use App\Models\TipoMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function(){
    Route::apiResource('tipo-menu', TipoMenuController::class);
    Route::apiResource('item-menu', ItemMenuController::class);
    Route::apiResource('menu', MenuController::class);
    Route::apiResource('menu-items', MenuItemMenuController::class);
    Route::apiResource('persona', PersonaController::class);
});
