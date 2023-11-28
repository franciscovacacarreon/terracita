<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ItemMenuController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuItemMenuController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RepartidorController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TipoMenuController;
use App\Http\Controllers\TipoVehiculoController;
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

    #Tipo menú
    Route::apiResource('tipo-menu', TipoMenuController::class);
    Route::get('tipo-menu-eliminados', [TipoMenuController::class, 'eliminados']);
    Route::get('tipo-menu-restaurar/{tipoMenu}', [TipoMenuController::class, 'restaurar']);

    #Item menú
    Route::apiResource('item-menu', ItemMenuController::class);

    #Menú
    Route::apiResource('menu', MenuController::class);

    #Menú item menu
    Route::apiResource('menu-items', MenuItemMenuController::class);

    #Personas
    Route::apiResource('persona', PersonaController::class);

    #cliente
    Route::apiResource('cliente', ClienteController::class);
    Route::get('cliente-eliminados', [ClienteController::class, 'eliminados']);
    Route::get('cliente-restaurar/{cliente}', [ClienteController::class, 'restaurar']);
    
    #Empleado
    Route::apiResource('empleado', EmpleadoController::class);
    Route::post('empleado/{empleado}', [EmpleadoController::class, 'update']); //Porque ocurrio un error al mandar datos por el formulario, por eso de tipo post
    Route::get('empleado-eliminados', [EmpleadoController::class, 'eliminados']);
    Route::get('empleado-restaurar/{empleado}', [EmpleadoController::class, 'restaurar']);

    #Repartidor
    Route::apiResource('repartidor', RepartidorController::class);
    Route::post('repartidor/{repartidor}', [RepartidorController::class, 'update']); //Porque ocurrio un error al mandar datos por el formulario, por eso de tipo post
    Route::get('repartidor-eliminados', [RepartidorController::class, 'eliminados']);
    Route::get('repartidor-restaurar/{repartidor}', [RepartidorController::class, 'restaurar']);

    #Roles
    Route::apiResource('rol', RolController::class);
    Route::get('rol-eliminados', [RolController::class, 'eliminados']);
    Route::get('rol-restaurar/{rol}', [RolController::class, 'restaurar']);

    #Tipo Vehiculo
    Route::apiResource('tipo-vehiculo', TipoVehiculoController::class);
    Route::get('tipo-vehiculo-eliminados', [TipoVehiculoController::class, 'eliminados']);
    Route::get('tipo-vehiculo-restaurar/{tipoVehiculo}', [TipoVehiculoController::class, 'restaurar']);
});
