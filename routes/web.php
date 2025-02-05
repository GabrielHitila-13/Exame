<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar rotas web para sua aplicação. Essas
| rotas são carregadas pelo RouteServiceProvider e todas elas serão
| atribuídas ao grupo de middleware "web". Faça algo incrível!
|
*/

// Rota para a página inicial
Route::get('/', function () {
    return view('home');
});

// Rotas para o controlador HomeController
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rotas para o controlador VeiculoController
use App\Http\Controllers\VeiculoController;
Route::resource('veiculos', VeiculoController::class);

// Rotas para o controlador ServicoController
use App\Http\Controllers\ServicoController;
Route::resource('servicos', ServicoController::class);

// Rotas para o controlador UserController com middleware de autenticação e papel de administrador
use App\Http\Controllers\UserController;
Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class)->except(['edit', 'update', 'show']);
    });
});

// Rotas de autenticação
Auth::routes();

// Rota para a página inicial do HomeController
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rotas para o controlador PagamentoController e VeiculoController com middleware de autenticação e papel de secretário
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\RelatorioController;
Route::middleware(['auth', 'secretario'])->group(function () {
    Route::resource('veiculos', VeiculoController::class); // Permite ao secretário registrar e ver viaturas
    Route::post('taxas', [PagamentoController::class, 'store'])->name('taxas.store'); // Registrar taxas de pagamento
    Route::get('relatorios', [VeiculoController::class, 'relatorios'])->name('relatorios.index'); // Gerar relatórios
});

// Rotas para o controlador VeiculoController com middleware de autenticação e papel de técnico
Route::middleware(['auth', 'tecnico'])->group(function () {
    Route::get('viaturas-tecnico', [VeiculoController::class, 'tecnico'])->name('tecnico.viaturas'); // Ver as viaturas atribuídas
    Route::put('alterar-estado/{veiculo}', [VeiculoController::class, 'alterarEstado'])->name('tecnico.alterarEstado'); // Alterar o estado da viatura
});

// Rotas para o controlador VeiculoController e PagamentoController com middleware de autenticação e papel de cliente
Route::middleware(['auth', 'cliente'])->group(function () {
    Route::get('consultar-estado/{veiculo}', [VeiculoController::class, 'consultarEstado'])->name('cliente.consultarEstado'); // Consultar o estado da viatura
    Route::post('solicitar-orcamento', [PagamentoController::class, 'solicitarOrcamento'])->name('cliente.solicitarOrcamento'); // Solicitar orçamento
    Route::post('efetuar-pagamento', [PagamentoController::class, 'efetuarPagamento'])->name('cliente.efetuarPagamento'); // Efetuar pagamento
    // Rota para o controlador PagamentoController
    Route::get('/pagamentos', [PagamentoController::class, 'index'])->name('pagamentos.index');
});

// Rota para o controlador VeiculoController com middleware de autenticação e papel de cliente
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/consultar', [VeiculoController::class, 'consultarEstado'])->name('veiculos.consultar');
});

// Rotas para o controlador DashboardController com middleware de autenticação
use App\Http\Controllers\DashboardController;
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard')->middleware('role:admin');
    Route::get('/secretario/dashboard', [DashboardController::class, 'secretario'])->name('secretario.dashboard')->middleware('role:secretario');
    Route::get('/tecnico/dashboard', [DashboardController::class, 'tecnico'])->name('tecnico.dashboard')->middleware('role:tecnico');
    Route::get('/meus-veiculos', [DashboardController::class, 'cliente'])->name('cliente.dashboard')->middleware('role:cliente');
});

// Rota para alterar o estado do veículo com middleware de autenticação
Route::middleware(['auth'])->group(function () {
    Route::post('/veiculos/{veiculo}/alterar_estado', [VeiculoController::class, 'alterarEstado'])->name('veiculos.alterar_estado');
    Route::post('/veiculos/{veiculo}/concluir', [VeiculoController::class, 'alterarEstado'])->name('veiculos.concluir');
        
});

// Rotas para eliminar conta do utilizador com middleware de autenticação e papel de cliente
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/cancelar-conta', [UserController::class, 'showCancelForm'])->name('cliente.cancelarConta');
    Route::delete('/cancelar-conta', [UserController::class, 'cancelarConta'])->name('cliente.cancelarConta.post');
});

// Rota para o controlador PortalController
use App\Http\Controllers\PortalController;
Route::get('/', [PortalController::class, 'index'])->name('portal.index');

// Rotas para o controlador RelatorioController
use Illuminate\Support\Facades\Route;
Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
Route::get('/relatorios/gerar', [RelatorioController::class, 'gerarRelatorio'])->name('relatorios.gerar');
Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorio.index');
// Rota para a página de registro
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Rota para concluir veículo no controlador VeiculoController
Route::post('/veiculos/{id}/concluir', [VeiculoController::class, 'concluirVeiculo'])->name('veiculos.concluir');


use App\Http\Controllers\TecnicoController;
Route::middleware(['auth', 'role:tecnico'])->group(function () {
    Route::get('/tecnico/viaturas', [TecnicoController::class, 'index'])->name('tecnico.viaturas');
    Route::post('/tecnico/viaturas/{veiculo}/atualizar-estado', [TecnicoController::class, 'atualizarEstado'])->name('tecnico.atualizarEstado');
    Route::post('/tecnico/viaturas/{veiculo}/adicionar-observacao', [TecnicoController::class, 'adicionarObservacao'])->name('tecnico.adicionarObservacao');
});

Route::get('/viaturas-tecnico', [VeiculoController::class, 'tecnico'])->name('veiculos.tecnico');
Route::post('/veiculos/{id}/alterar_estado', [VeiculoController::class, 'alterarEstado'])->name('veiculos.alterar_estado');
Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');
