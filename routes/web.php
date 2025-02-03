<?php

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
    return view('layouts.app');
});

use App\Http\Controllers\VeiculoController;
Route::resource('veiculos', VeiculoController::class);

use App\Http\Controllers\ServicoController;
Route::resource('servicos', ServicoController::class);


use App\Http\Controllers\UserController;
Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class)->except(['edit', 'update', 'show']);
    });
});

// Rotas de autenticação
Auth::routes();