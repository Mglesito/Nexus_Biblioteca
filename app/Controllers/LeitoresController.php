<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AlunoModel;
use App\Models\EmprestimoModel;

class LeitoresController extends BaseController
{
    private $AlunoModel;
    private $EmprestimoModel;
    
    public function __contruct(){
        $this->AlunoModel = new AlunoModel();
        $this->EmprestimoModel = new EmprestimoModel();
    }
    
    public function index()
    {
        $this->verificarBibliotecario();

        // Buscar alunos com empréstimos ativos
        $leitoresAtivos = $this->getLeitoresComEmprestimosAtivos();
        
        return view('leitores/leitores', [
            'leitores' => $leitoresAtivos
        ]);
    }

    public function listar(){
        return $this->AlunoModel->findAll();
    }
    
    /**
     * Retorna alunos que possuem empréstimos ativos (não devolvidos)
     */
    private function getLeitoresComEmprestimosAtivos()
    {
        $db = \Config\Database::connect();
        
        return $db->table('aluno')
            ->select('aluno.cpf, aluno.nome, aluno.turma, aluno.curso, COUNT(emprestimo.id) as emprestimos_ativos')
            ->join('emprestimo', 'emprestimo.cpf = aluno.cpf AND emprestimo.devolvido = 0', 'inner')
            ->groupBy('aluno.cpf')
            ->get()
            ->getResultArray();
    }
}
