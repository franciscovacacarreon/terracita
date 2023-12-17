<?php

use App\Http\Controllers\AdminGentella;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteWeb;
use App\Http\Controllers\ClienteWebController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ItemMenuController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\NotaVentaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\RepartidorController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TipoMenuController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\TipoVehiculoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rutas protegidas por middleware 'auth'
Route::middleware(['auth'])->group(function () {
    Route::get('tipo-menu', [TipoMenuController::class, 'getIndex']);
    Route::get('item-menu', [ItemMenuController::class, 'getIndex']);
    Route::get('cliente', [ClienteController::class, 'getIndex']);
    Route::get('empleado', [EmpleadoController::class, 'getIndex']);
    Route::get('repartidor', [RepartidorController::class, 'getIndex']);
    Route::get('rol', [RolController::class, 'getIndex']);
    Route::get('rol-error', [RolController::class, 'getError']);
    Route::get('tipo-vehiculo', [TipoVehiculoController::class, 'getIndex']);
    Route::get('tipo-pago', [TipoPagoController::class, 'getIndex']);
    Route::get('vehiculo', [VehiculoController::class, 'getIndex']);
    Route::get('user', [UserController::class, 'getIndex']);
    Route::get('bienvenido', [UserController::class, 'getBienvenido']);

    ////Menu////
    Route::get('menu', [MenuController::class, 'getIndex']);
    Route::get('menu-create', [MenuController::class, 'getCreate']);
    Route::get('menu-edit', [MenuController::class, 'getEdit']);
    ///Fin menu///

    ////Nota venta////
    Route::get('nota-venta', [NotaVentaController::class, 'getIndex']);
    Route::get('nota-venta-create', [NotaVentaController::class, 'getCreate']);
    Route::get('nota-venta-comprobante-pdf/{id}', [NotaVentaController::class, 'getComprobantePdf']);
    ///Fin venta///

    ////Nota pedido////
    Route::get('pedido', [PedidoController::class, 'getIndex']);
    Route::get('pedido/detalle/{idPedido}', [PedidoController::class, 'getDetallePedido']);
    Route::get('mispedidos', [PedidoController::class, 'getMisPedidos']);
    ///Fin venta///

    Route::get('restaurante-setting', [RestauranteController::class, 'getIndex']);
});

//Para el pedido (cliente web)
Route::get('cliente-web', [ClienteWebController::class, 'getIndex']);
Route::get('cliente-web-form', [ClienteWebController::class, 'getForm']);
Route::get('cliente-web-confirmar', [ClienteWebController::class, 'getConfirmar']);
Route::get('cliente-web-detalle/{idPedido}', [ClienteWebController::class, 'getDetallePedido']);
Route::get('cliente-web-mis-pedidos/{idCliente}', [ClienteWebController::class, 'getMisPedidos']);
Route::get('cliente-web-paypal', [ClienteWebController::class, 'getPaypal']);


//para generar el pdf
Route::get('nota-venta-comprobante/{id}', [NotaVentaController::class, 'getComprobante']);