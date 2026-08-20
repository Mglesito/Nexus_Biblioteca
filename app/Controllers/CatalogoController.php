<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LivroModel;
use CodeIgniter\HTTP\ResponseInterface;

class CatalogoController extends BaseController
{
    public function index()
    {
        if ($redirect = $this->verificarAluno()) {
            return $redirect;
        }

        return view('catalogo/catalogo', [
            'livros' => (new LivroModel())->listarDisponiveis(),
        ]);
    }
}
