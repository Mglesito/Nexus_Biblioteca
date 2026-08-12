<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardEmprestimoBibliotecarioController extends BaseController
{
    public function index()
    {
        return view('emprestimo/emprestimos');
    }
}
