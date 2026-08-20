<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlunoModel;
use App\Models\EmprestimoModel;
use App\Models\LivroModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardAlunoController extends BaseController
{
    public function index()
    {
        if ($redirect = $this->verificarAluno()) {
            return $redirect;
        }

        $cpf = session()->get('cpf');
        $aluno = (new AlunoModel())->find($cpf);
        $livroModel = new LivroModel();
        $emprestimos = (new EmprestimoModel())->listarPorAluno($cpf);
        $ativos = array_values(array_filter($emprestimos, static fn ($emprestimo) => (int) $emprestimo['devolvido'] === 0));

        return view('dashboard/dashboard-aluno', [
            'aluno' => $aluno,
            'totalLivros' => $livroModel->totalLivros(),
            'livrosDisponiveis' => $livroModel->livrosDisponiveis(),
            'emprestimosAtivos' => $ativos,
            'emprestimosEmAtraso' => count(array_filter($ativos, static fn ($emprestimo) => $emprestimo['data_devolucao'] < date('Y-m-d'))),
        ]);
    }
}
