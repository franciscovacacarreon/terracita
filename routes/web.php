<?php

use App\Http\Controllers\AdminGentella;
use App\Http\Controllers\ClienteWeb;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TipoMenuController;
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
    return view('welcome');
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


// Route::get('admin', [AdminGentella::class, 'index']);

Route::get('cliente-web', [ClienteWeb::class, 'index']);

Route::controller(TipoMenuController::class)->group(function(){
    Route::get('/tipo-menu', 'getIndex');
});