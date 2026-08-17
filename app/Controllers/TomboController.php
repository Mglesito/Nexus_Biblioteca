<?php

namespace App\Controllers;

use App\Models\TomboModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TomboController extends BaseController
{
    private $TomboModel;

    public function __construct(){
        $this->TomboModel = new TomboModel();
    }

    public function index()
    {
        $Tombo = $this->listar();
        echo view('tombo/tombo', [
            'Tombo' => $Tombo
        ]);
    }

    public function listar(){
        return $this->TomboModel->findAll();
    }

    public function salvar(){
        $Tombo = $this->request->getPost();
        $this->TomboModel->save($Tombo);
        return redirect()->to('/bibliotecario/tombo');
    }

    public function procurar($registro){
        $tombo = $this->TomboModel->find($registro);
        return $tombo;
    }

    public function editar($registro){
        $Tombo = $this->procurar($registro);
        echo view('tombo/edit', ['Tombo' => $Tombo]);
    }

    public function excluir($registro){
        $this->TomboModel->delete($registro);
        return redirect()->to('/bibliotecario/tombo');
    }
}
