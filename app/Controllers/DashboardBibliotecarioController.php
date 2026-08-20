<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LivroModel;
use App\Models\AlunoModel;
use App\Models\EmprestimoModel;

class DashboardBibliotecarioController extends BaseController
{
    private $LivroModel;
    private $AlunoModel;
    private $EmprestimoModel;

    public function __construct()
    {
        $this->LivroModel = new LivroModel();
        $this->AlunoModel = new AlunoModel();
        $this->EmprestimoModel = new EmprestimoModel();
    }

    public function index()
    {
        $this->verificarBibliotecario();

        // Dados dos livros
        $totalLivros = $this->LivroModel->totalLivros();
        $livrosDisponiveis = $this->LivroModel->livrosDisponiveis();
        $livrosEmprestados = $this->LivroModel->livrosEmprestados();

        // Dados dos alunos
        $totalAlunos = $this->AlunoModel->totalAlunos();
        $alunosEmAtraso = $this->EmprestimoModel->contarAlunosEmAtraso();

        // Empréstimos em atraso
        $emprestimosEmAtraso = $this->EmprestimoModel->listarEmAtraso();

        return view('dashboard_biblioteca/dashboard-bibliotecario', [
            'totalLivros' => $totalLivros,
            'livrosDisponiveis' => $livrosDisponiveis,
            'livrosEmprestados' => $livrosEmprestados,
            'totalAlunos' => $totalAlunos,
            'alunosEmAtraso' => $alunosEmAtraso,
            'emprestimosEmAtraso' => $emprestimosEmAtraso
        ]);
    }
}
