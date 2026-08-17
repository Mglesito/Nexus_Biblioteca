<?php

namespace App\Controllers;

use App\Models\AlunoModel;
use App\Controllers\LoginController;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CadastroAlunoController extends BaseController
{
    private $AlunoModel;
    private $LoginController;
    public function __construct(){
        $this->AlunoModel = new AlunoModel();
        $this->LoginController = new LoginController();
    }
    public function index()
    {
        return view('cadastro_aluno/cadastro-aluno');
    }

    public function listar(){
        return $this->AlunoModel->findAll();
    }

    public function salvar(){
        $Aluno = $this->request->getPost();
        $this->LoginController->salvar($Aluno);
        $this->AlunoModel->save($Aluno);
        return redirect()->to('/bibliotecario/cadastro_aluno');
    }

    public function procurar($cpf){
        $Aluno = $this->AlunoModel->find($cpf);
        return $Aluno;
    }

    public function editar($cpf){
        $Aluno = $this->procurar($cpf);
        echo view('cadastro_aluno/edit', ['Aluno' => $Aluno]);
    }

    public function excluir($cpf){
        $this->AlunoModel->delete($cpf);
        return redirect()->to('/bibliotecario/cadastro_aluno');
    }
}
