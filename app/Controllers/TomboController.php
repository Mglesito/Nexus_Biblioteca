<?php

namespace App\Controllers;

use App\Models\TomboModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\HistoricoModel;

class TomboController extends BaseController
{
    private $TomboModel;
    private $HistoricoModel;

    public function __construct(){
        $this->TomboModel = new TomboModel();
        $this->HistoricoModel = new HistoricoModel();
    }

    public function index()
    {
        $this->verificarBibliotecario();

        $Tombo = $this->listar();
        echo view('tombo/tombo', [
            'Tombo' => $Tombo
        ]);
    }

    public function listar(){
        return $this->TomboModel->findAll();
    }

    public function salvar(){
        if ($redirect = $this->verificarBibliotecario()) {
            return $redirect;
        }

        $Tombo = $this->request->getPost();
        $isUpdate = !empty($Tombo['registro']) && $this->TomboModel->find($Tombo['registro']);
        
        $Tombo['data_entrada'] = date('Y-m-d');
        $this->TomboModel->save($Tombo);

        // Registrar no histórico
        if ($isUpdate) {
            $this->HistoricoModel->registrarAcao(
                'EDICAO_TOMBO',
                null,
                null,
                $Tombo['registro'],
                $Tombo['titulo'] ?? 'Desconhecido',
                'Tombo atualizado'
            );
        } else {
            $this->HistoricoModel->registrarAcao(
                'CADASTRO_TOMBO',
                null,
                null,
                $Tombo['registro'],
                $Tombo['titulo'] ?? 'Desconhecido',
                'Novo tombo cadastrado'
            );
        }

        return redirect()->to('/bibliotecario/tombo');
    }

    public function procurar($registro){
        $tombo = $this->TomboModel->find($registro);
        return $tombo;
    }

    public function editar($registro){
        if ($redirect = $this->verificarBibliotecario()) {
            return $redirect;
        }

        $Tombo = $this->procurar($registro);
        echo view('tombo/edit', ['Tombo' => $Tombo]);
    }

    public function excluir($registro){
        if ($redirect = $this->verificarBibliotecario()) {
            return $redirect;
        }

        $tombo = $this->TomboModel->find($registro);
        
        if ($tombo) {
            $this->TomboModel->delete($registro);

            // Registrar no histórico
            $this->HistoricoModel->registrarAcao(
                'EXCLUSAO_TOMBO',
                null,
                null,
                $registro,
                $tombo['titulo'] ?? 'Desconhecido',
                'Tombo excluído do sistema'
            );
        }

        return redirect()->to('/bibliotecario/tombo');
    }
}
