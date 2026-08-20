<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\LivroController;

class AcervoController extends BaseController
{
    private $LivroController;
    public function __construct(){
        $this->LivroController = new LivroController();
    }
    public function index()
    {
        $this->verificarBibliotecario();

        $Acervo = $this->LivroController->listar();

        return view('acervo/acervo', [
            'Acervo' => $Acervo
        ]);
    }
}
