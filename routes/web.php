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

// Rotas de autenticação
Auth::routes();
Route::get('/register', function () {
    return view('auth.register');
})->name('register'); // Página de registro

// Rotas para o controlador HomeController
use App\Http\Controllers\HomeController;
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rotas para o controlador VeiculoController
use App\Http\Controllers\VeiculoController;
Route::resource('veiculos', VeiculoController::class);
Route::get('/veiculo', [HomeController::class, 'index'])->name('veiculo');
Route::get('veiculos.detalhes', [VeiculoController::class, 'show'])->name('show.index'); // Gerar relatórios
Route::post('/veiculos/{id}', [VeiculoController::class, 'alterarEstado'])->name('veiculos.alterar_estado'); // Alterar estado do veículo
Route::get('/veiculos/{id}', [VeiculoController::class, 'show'])->name('veiculos.show');
Route::get('/veiculos/{id}/alterar-estado', [VeiculoController::class, 'alterarEstado'])->name('veiculos.alterarEstado');
Route::post('/veiculos/{id}/concluir', [VeiculoController::class, 'concluirVeiculo'])->name('veiculos.concluir'); // Concluir veículo
Route::get('/veiculos', [VeiculoController::class, 'index'])->name('veiculos.index'); // Listar veículos
Route::get('/veiculos.consultar', [VeiculoController::class, 'consultarestado'])->name('veiculos.consultar'); // Listar veículos

Route::post('/veiculos', [VeiculoController::class, 'store'])->name('veiculos.store');

// Rotas para o controlador ServicoController
use App\Http\Controllers\ServicoController;
Route::resource('servicos', ServicoController::class);

// Rotas para o controlador UserController com middleware de autenticação e papel de administrador
use App\Http\Controllers\UserController;
Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class)->except(['edit', 'update', 'show']);
        Route::get('/veiculos/index', [VeiculoController::class, 'index'])->name('veiculos.show'); // Listar veículos
        Route::get('/cancelar-conta', [UserController::class, 'showCancelForm'])->name('cliente.cancelarConta'); // Mostrar formulário de cancelamento de conta
        Route::get('/veiculos/create', [VeiculoController::class, 'create'])->name('veiculos.create')->middleware('auth');

    });
    // Rotas para editar User
    Route::get('/users/{user}/editar', [UserController::class, 'edit'])->name('users.edit'); // Editar usuário
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update'); // Atualizar usuário
});

// Rotas para o controlador PagamentoController e VeiculoController com middleware de autenticação e papel de secretário IMPORTANT
use App\Http\Controllers\PagamentoController;
Route::middleware(['auth', 'secretario'])->group(function () {
    Route::post('taxas', [PagamentoController::class, 'store'])->name('taxas.store'); // Registrar taxas de pagamento
    Route::get('relatorios', [VeiculoController::class, 'relatorios'])->name('relatorios.index'); // Gerar relatórios
    Route::get('veiculos.index', [VeiculoController::class, 'index'])->name('veiculos.index'); // Gerar relatórios
    Route::get('veiculos/{veiculo}', [VeiculoController::class, 'consultarEstado'])->name('veiculos.consultar'); // Gerar relatórios
    //Route::resource('veiculos/create', [VeiculoController::class, 'create'])->name('veiculos.create');;
    Route::get('/veiculos/create', [VeiculoController::class, 'create'])->name('veiculos.create')->middleware('auth'); // Exibir formulário de cadastro de veículo
    Route::post('/veiculos', [VeiculoController::class, 'store'])->name('veiculos.store')->middleware('auth');// Cadastrar veículo IP com autenticacao


});

// Rotas para o controlador VeiculoController com middleware de autenticação e papel de técnico
Route::middleware(['auth', 'tecnico'])->group(function () {
    Route::get('tecnico/viaturas', [VeiculoController::class, 'tecnico'])->name('tecnico.viaturas'); // Ver as viaturas atribuídas
});

// Rotas para o controlador VeiculoController e PagamentoController com middleware de autenticação e papel de cliente
Route::middleware(['auth', 'cliente'])->group(function () {
    Route::get('consultar-estado/{veiculo}', [VeiculoController::class, 'consultarEstado'])->name('cliente.consultarEstado'); // Consultar o estado da viatura
    Route::post('solicitar-orcamento', [PagamentoController::class, 'solicitarOrcamento'])->name('cliente.solicitarOrcamento'); // Solicitar orçamento
    Route::post('efetuar-pagamento', [PagamentoController::class, 'efetuarPagamento'])->name('cliente.efetuarPagamento'); // Efetuar pagamento
    Route::get('/pagamentos', [PagamentoController::class, 'index'])->name('pagamentos.index'); // Listar pagamentos
    Route::get('/veiculos', [VeiculoController::class, 'index'])->name('consultar.index'); // Listar pagamentos

});

// Rota para o controlador VeiculoController com middleware de autenticação e papel de cliente
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/veiculos/consultar', [VeiculoController::class, 'consultarEstado'])->name('veiculos.consultar'); // Consultar estado do veículo
});

// Rota para o controlador VeiculoController com middleware de autenticação e papel de secretario
Route::middleware(['auth', 'role:secretario'])->group(function () {
    Route::get('/consultar', [VeiculoController::class, 'consultarEstado'])->name('veiculos.consultar'); // Consultar estado do veículo
});
// Rotas para o controlador DashboardController com middleware de autenticação
use App\Http\Controllers\DashboardController;
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard')->middleware('role:admin'); // Dashboard do administrador
    Route::get('/secretario/dashboard', [DashboardController::class, 'secretario'])->name('secretario.dashboard')->middleware('role:secretario'); // Dashboard do secretário
    Route::get('/tecnico/dashboard', [DashboardController::class, 'tecnico'])->name('tecnico.dashboard')->middleware('role:tecnico'); // Dashboard do técnico
    Route::get('/client/dashboards', [DashboardController::class, 'cliente'])->name('cliente.dashboard')->middleware('role:cliente'); // Dashboard do cliente
});

// Rota para alterar o estado do veículo com middleware de autenticação
Route::middleware(['auth'])->group(function () {
    Route::post('/veiculos/{user}/alterar_estado', [VeiculoController::class, 'alterarEstado'])->name('veiculos.alterar_estado'); // Alterar estado do veículo
    Route::post('/veiculos/{veiculo}/concluir', [VeiculoController::class, 'alterarEstado'])->name('veiculos.concluir'); // Concluir veículo
});

// Rotas para eliminar conta do utilizador com middleware de autenticação e papel de cliente
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/cancelar-conta', [UserController::class, 'showCancelForm'])->name('cliente.cancelarConta'); // Mostrar formulário de cancelamento de conta
    Route::delete('/cancelar-conta', [UserController::class, 'cancelarConta'])->name('cliente.cancelarConta.post'); // Cancelar conta
});
Route::middleware(['auth', 'role:tecnico'])->group(function () {
    Route::get('/tecnico/index', [DashboardController::class, 'tecnico'])->name('dashboards.tecnico'); // Dashboard do técnico
});

// Rota para o controlador PortalController
use App\Http\Controllers\PortalController;
Route::get('/', [PortalController::class, 'index'])->name('portal.index'); // Página inicial do portal

// Rotas para o controlador RelatorioController
use App\Http\Controllers\RelatorioController;
Route::get('/relatorios/gerar', [RelatorioController::class, 'gerarRelatorio'])->name('relatorios.gerar'); // Gerar relatório
Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index'); // Listar relatórios

// Rotas para o controlador TecnicoController
use App\Http\Controllers\TecnicoController;
Route::middleware(['auth', 'role:tecnico'])->group(function () {
    Route::get('/tecnico/viaturas', [TecnicoController::class, 'index'])->name('tecnico.viaturas'); // Listar viaturas do técnico
    Route::post('/tecnico/viaturas/{veiculo}/atualizar-estado', [TecnicoController::class, 'atualizarEstado'])->name('tecnico.atualizarEstado'); // Atualizar estado da viatura
    Route::post('/tecnico/viaturas/{veiculo}/adicionar-observacao', [TecnicoController::class, 'adicionarObservacao'])->name('tecnico.adicionarObservacao'); // Adicionar observação à viatura
});

Route::get('/viaturas-tecnico', [VeiculoController::class, 'tecnico'])->name('veiculos.tecnico'); // Listar viaturas do técnico
Route::post('/veiculos/{id}/alterar_estado', [VeiculoController::class, 'alterarEstado'])->name('veiculos.alterar_estado'); // Alterar estado do veículo

Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
