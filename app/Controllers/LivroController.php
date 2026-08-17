<?php

namespace App\Controllers;

use App\Models\LivroModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LivroController extends BaseController
{
    private $LivroModel;
    public function __construct(){
        $this->LivroModel = new LivroModel();
    }
    public function index()
    {
        return view('livro/cadastro-livro');
    }

    public function listar(){
        return $this->LivroModel->findAll();
    }

    public function salvar(){
        $Livro = $this->request->getPost();
        $this->LivroModel->save($Livro);
        return redirect()->to('/bibliotecario/livros');
    }

    public function procurar($id){
        $Livro = $this->LivroModel->find($id);
        return $Livro;
    }

    public function editar($id){
        $Livro = $this->procurar($id);
        echo view('livro/edit', ['Livro' => $Livro]);
    }

    public function excluir($id){
        $this->LivroModel->delete($id);
        return redirect()->to('/bibliotecario/livros');
    }
}
