<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Veiculo;

class VeiculoController extends Controller
{
    /**
     * Exibe todas as viaturas registradas (somente para secretário e administrador).
     */
    public function index()
    {
        $veiculos = Veiculo::all();
        return view('veiculos.index', compact('veiculos'));
    }

    /**
     * Exibe o formulário de cadastro de uma nova viatura (somente para secretário).
     */
    public function create()
    {
        return view('veiculos.create');
    }

    /**
     * Armazena uma nova viatura no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'tipo_avaria' => 'required|string|max:255',
            'codigo_validacao' => 'required|unique:veiculos|string|max:10',
        ]);

        $veiculo = new Veiculo($request->all());
        $veiculo->codigo_validacao = strtoupper(uniqid());
        $veiculo->save();

        return redirect()->route('veiculos.index')->with('success', 'Veículo cadastrado com sucesso!');
    }

    /**
     * Exibe detalhes de uma viatura específica.
     */
    public function show(Veiculo $veiculo)
    {
        return view('veiculos.detalhes', compact('veiculo'));
    }

    /**
     * Exibe formulário de edição de uma viatura (somente para secretário).
     */
    public function edit(Veiculo $veiculo)
    {
        return view('veiculos.edit', compact('veiculo'));
    }

    /**
     * Atualiza as informações de uma viatura.
     */
    public function update(Request $request, Veiculo $veiculo)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'cor' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'tipo_avaria' => 'required|string|max:255',
        ]);

        $veiculo->update($request->all());

        return redirect()->route('veiculos.index')->with('success', 'Veículo atualizado com sucesso!');
    }

    /**
     * Remove uma viatura do sistema.
     */
    public function destroy(Veiculo $veiculo)
    {
        $veiculo->delete();
        return redirect()->route('veiculos.index')->with('success', 'Veículo excluído com sucesso!');
    }

    /**
     * Exibe viaturas atribuídas a um técnico.
     */
    public function tecnico()
    {
        $veiculos = Veiculo::where('estado', 'Em manutenção')->get();
        return view('tecnico.index', compact('veiculos'));
    }

    /**
     * Permite ao técnico alterar o estado da viatura após diagnóstico e solução.
     */
    public function alterarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|string|max:255',
            'codigo_validacao' => 'required|string',
            'password' => 'required|string',
        ]);

        $veiculo = Veiculo::findOrFail($id);

        // Verificar código de validação
        if ($veiculo->codigo_validacao !== $request->codigo_validacao) {
            return back()->with('error', 'Código de validação incorreto.');
        }

        // Verificar senha do usuário autenticado
        if (!Hash::check($request->password, auth()->user()->password)) {
            return back()->with('error', 'Senha incorreta.');
        }

        // Atualizar o estado da viatura
        $veiculo->estado = $request->estado;
        $veiculo->save();

        return redirect()->route('tecnico.index')->with('success', 'Estado do veículo alterado com sucesso!');
    }

    /**
     * Permite ao cliente consultar o estado da sua viatura.
     */
    public function consultarEstado()
    {
        $user = auth()->user();
        $veiculos = Veiculo::where('user_id', $user->id)->get();
        return view('veiculos.consultar', compact('veiculos'));
    }

    /**
     * Marca um veículo como concluído e gera um QR Code com as informações.
     */
    public function concluirVeiculo($id)
    {
        $veiculo = Veiculo::findOrFail($id);

        // Verifica se já está concluído
        if ($veiculo->estado === 'Concluído') {
            return back()->with('error', 'O veículo já está concluído.');
        }

        // Atualiza o estado do veículo
        $veiculo->estado = 'Concluído';
        $veiculo->save();

        // Gera QR Code com informações do veículo
        $data = "Nome da Oficina: Oficina XYZ\n";
        $data .= "Endereço: Rua 123, Cidade ABC\n";
        $data .= "Data de Saída: " . now()->format('d/m/Y');

        // Criar o QR Code
        $qrCode = QrCode::create($data);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Definir o caminho para salvar o QR Code
        $qrCodePath = public_path('qrcodes/' . $veiculo->id . '.png');

        // Salvar o QR Code
        file_put_contents($qrCodePath, $result->getString());

        // Redirecionar com o QR Code
        return redirect()->route('veiculos.show', $veiculo->id)
            ->with('qrCodePath', asset('qrcodes/' . $veiculo->id . '.png'))
            ->with('success', 'Veículo concluído com sucesso!');
    }
}
