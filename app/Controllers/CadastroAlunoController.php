<?php

namespace App\Controllers;

use App\Models\AlunoModel;
use App\Controllers\LoginController;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\HistoricoModel;

class CadastroAlunoController extends BaseController
{
    private $AlunoModel;
    private $LoginController;
    private $HistoricoModel;

    public function __construct(){
        $this->AlunoModel = new AlunoModel();
        $this->LoginController = new LoginController();
        $this->HistoricoModel = new HistoricoModel();
    }
    public function index()
    {
        $this->verificarBibliotecario();

        $Aluno = $this->listar();
        echo view('cadastro_aluno/cadastro-aluno', [
            'Aluno' => $Aluno
        ]);
    }

    public function listar(){
        return $this->AlunoModel->findAll();
    }

    public function salvar(){
        if ($redirect = $this->verificarBibliotecario()) {
            return $redirect;
        }

        $Aluno = $this->request->getPost();
        $this->LoginController->salvar($Aluno);
        $this->AlunoModel->save($Aluno);

        // Registrar no histórico
        $this->HistoricoModel->registrarAcao(
            'CADASTRO_ALUNO',
            $Aluno['cpf'] ?? null,
            $Aluno['nome'] ?? 'Desconhecido',
            null,
            null,
            'Aluno cadastrado no sistema'
        );

        return redirect()->to('/bibliotecario/cadastro_aluno');
    }

    public function procurar($cpf){
        $Aluno = $this->AlunoModel->find($cpf);
        return $Aluno;
    }

    public function editar($cpf){
        if ($redirect = $this->verificarBibliotecario()) {
            return $redirect;
        }

        $Aluno = $this->procurar($cpf);
        echo view('cadastro_aluno/edit', ['Aluno' => $Aluno]);
    }

    public function excluir($cpf){
        if ($redirect = $this->verificarBibliotecario()) {
            return $redirect;
        }

        $this->AlunoModel->delete($cpf);
        return redirect()->to('/bibliotecario/cadastro_aluno');
    }
}
