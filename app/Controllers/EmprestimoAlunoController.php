<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class EmprestimoAlunoController extends BaseController
{
    public function index()
    {
        return view('emprestimo_aluno/meu-emprestimo');
    }
}
