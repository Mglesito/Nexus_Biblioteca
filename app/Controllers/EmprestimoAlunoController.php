<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmprestimoModel;
use CodeIgniter\HTTP\ResponseInterface;

class EmprestimoAlunoController extends BaseController
{
    public function index()
    {
        if ($redirect = $this->verificarAluno()) {
            return $redirect;
        }

        return view('emprestimo_aluno/meu-emprestimo', [
            'emprestimos' => (new EmprestimoModel())->listarPorAluno(session()->get('cpf')),
        ]);
    }
}
