<?php
use App\Models\Veiculo;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorios.index');
    }

    public function numeroViaturas()
    {
        $total = Veiculo::count();
        return view('relatorios.numero_viaturas', compact('total'));
    }

    public function viaturasConcluidas()
    {
        $concluidas = Veiculo::where('estado', 'Concluído')->count();
        return view('relatorios.viaturas_concluidas', compact('concluidas'));
    }

    public function viaturasPendentes()
    {
        $pendentes = Veiculo::where('estado', '!=', 'Concluído')->count();
        return view('relatorios.viaturas_pendentes', compact('pendentes'));
    }
}
