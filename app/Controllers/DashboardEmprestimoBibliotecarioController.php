<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmprestimoModel;

class DashboardEmprestimoBibliotecarioController extends BaseController
{
    private $EmprestimoModel;

    public function __construct(){
        $this->EmprestimoModel = new EmprestimoModel();
    }
    public function index()
    {
        return view('emprestimo/emprestimos');
    }

    public function listar(){
        return $this->EmprestimoModel->findAll();
    }

    public function salvar(){
        $Emprestimo = $this->request->getPost();
        $dataDevolucao = date('Y-m-d', strtotime('+15 days'));
        $Emprestimo['data_devolucao'] = $dataDevolucao;
        $this->EmprestimoModel->save($Emprestimo);
        return redirect()->to('/bibliotecario/emprestimos');
    }

    public function procurar($id){
        $Emprestimo = $this->EmprestimoModel->find($id);
        return $Emprestimo;
    }

    public function editar($id){
        $Emprestimo = $this->procurar($id);
        echo view('tombo/edit', ['Emprestimo' => $Emprestimo]);
    }

    public function excluir($id){
        $this->EmprestimoModel->delete($id);
        return redirect()->to('/bibliotecario/emprestimos');
    }
}
