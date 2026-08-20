<?php

namespace App\Controllers;

use App\Models\LivroModel;
use App\Controllers\TomboController;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LivroController extends BaseController
{
    private $LivroModel;
    private $TomboController;
    public function __construct(){
        $this->LivroModel = new LivroModel();
        $this->TomboController =  new TomboController();
    }
    public function index()
    {
        $this->verificarBibliotecario();

        return view('livro/cadastro-livro');
    }

    public function listar(){
        return $this->LivroModel->findAll();
    }

    public function salvar(){
        if ($redirect = $this->verificarBibliotecario()) {
            return $redirect;
        }

        $Livro = $this->request->getPost();
        $Dados = $this->TomboController->procurar($Livro['registro']);
        $Livro['titulo'] = $Dados['titulo'];
        $Livro['autor'] = $Dados['autor'];
        $this->LivroModel->save($Livro);
        return redirect()->to('/bibliotecario/livros');
    }

    public function procurar($id){
        $Livro = $this->LivroModel->find($id);
        return $Livro;
    }

    public function editar($id){
        if ($redirect = $this->verificarBibliotecario()) {
            return $redirect;
        }

        $Livro = $this->procurar($id);
        echo view('livro/edit', ['Livro' => $Livro]);
    }

    public function excluir($id){
        if ($redirect = $this->verificarBibliotecario()) {
            return $redirect;
        }

        $this->LivroModel->delete($id);
        return redirect()->to('/bibliotecario/livros');
    }
}
