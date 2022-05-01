<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoicesController;

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

Auth::routes();
Route::get('logout',[LoginController::class, 'logout']);
Route::get('refresh',[LoginController::class, 'refresh']);

//Se crea la validación para verificar que las rutas tengan el token para poder seguir con las respectivas rutas
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::resource('products',ProductsController::class);
    Route::resource('invoices',InvoicesController::class);
});