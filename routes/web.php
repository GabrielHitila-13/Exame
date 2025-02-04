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
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// use App\Http\Controllers\VeiculoController; Esta a ser importado + de uma
use App\Http\Controllers\PagamentoController;

Route::middleware(['auth', 'secretario'])->group(function () {
    Route::resource('veiculos', VeiculoController::class); // Permite ao secretário registrar e ver viaturas
    Route::post('taxas', [PagamentoController::class, 'store'])->name('taxas.store'); // Registrar taxas de pagamento
    Route::get('relatorios', [VeiculoController::class, 'relatorios'])->name('relatorios.index'); // Gerar relatórios
});

Route::middleware(['auth', 'tecnico'])->group(function () {
    Route::get('viaturas-tecnico', [VeiculoController::class, 'tecnico'])->name('tecnico.viaturas'); // Ver as viaturas atribuídas
    Route::put('alterar-estado/{veiculo}', [VeiculoController::class, 'alterarEstado'])->name('tecnico.alterarEstado'); // Alterar o estado da viatura
});

Route::middleware(['auth', 'cliente'])->group(function () {
    Route::get('consultar-estado/{veiculo}', [VeiculoController::class, 'consultarEstado'])->name('cliente.consultarEstado'); // Consultar o estado da viatura
    Route::post('solicitar-orcamento', [PagamentoController::class, 'solicitarOrcamento'])->name('cliente.solicitarOrcamento'); // Solicitar orçamento
    Route::post('efetuar-pagamento', [PagamentoController::class, 'efetuarPagamento'])->name('cliente.efetuarPagamento'); // Efetuar pagamento
});

// use App\Http\Controllers\VeiculoController;

Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/consultar', [VeiculoController::class, 'consultarEstado'])->name('veiculos.consultar');
});

use App\Http\Controllers\DashboardController;

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard')->middleware('role:admin');
    Route::get('/secretario/dashboard', [DashboardController::class, 'secretario'])->name('secretario.dashboard')->middleware('role:secretario');
    Route::get('/tecnico/dashboard', [DashboardController::class, 'tecnico'])->name('tecnico.dashboard')->middleware('role:tecnico');
    Route::get('/meus-veiculos', [DashboardController::class, 'cliente'])->name('cliente.dashboard')->middleware('role:cliente');
});
