<?php

namespace App\Http\Controllers;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboards.admin');
    }

    public function secretario()
    {
        $veiculo = Veiculo::find(1); // Substitua 1 pelo ID apropriado ou outra lógica de seleção

        return view('dashboards.secretario', compact('veiculo'));
    }

    public function tecnico()
    {
        return view('dashboards.tecnico');
    }

    public function cliente()
    {
        return view('dashboards.cliente');
    }
}
