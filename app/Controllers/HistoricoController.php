<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\HistoricoModel;

class HistoricoController extends BaseController
{
    private $HistoricoModel;

    public function __construct()
    {
        $this->HistoricoModel = new HistoricoModel();
    }

    public function index()
    {
        $this->verificarBibliotecario();

        $historico = $this->HistoricoModel->listarHistorico();

        return view('historico/historico', [
            'historico' => $historico
        ]);
    }
}
