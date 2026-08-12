<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CadastroAlunoController extends BaseController
{
    public function index()
    {
        return view('cadastro_aluno/cadastro-aluno');
    }
}
