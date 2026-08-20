<?php

namespace App\Controllers;

use App\Models\BibliotecarioModel;
use App\Models\UsuarioModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SuporteController extends BaseController
{
   private const TIPO_USUARIO_BIBLIOTECARIO = 2;

    private $UsuarioModel;
    private $BibliotecarioModel;

    public function __construct(){
        $this->UsuarioModel = new UsuarioModel();
        $this->BibliotecarioModel = new BibliotecarioModel();
    }

    public function index(){
        $this->verificarSuporte();

        $Bibliotecarios = $this->BibliotecarioModel->findAll();

        return view('suporte/suporte', [
            'Bibliotecarios' => $Bibliotecarios
        ]);
    }
    //Nota do dev, alguem me ajuda por favor 
    public function salvar()
    {
        if ($redirect = $this->verificarSuporte()) {
            return $redirect;
        }

        $dados = $this->request->getPost();

        $Usuario = [
            'cpf' => $dados['cpf'],
            'email' => $dados['email'],
            'senha' => $dados['senha'],
            'tipo_usuario' => self::TIPO_USUARIO_BIBLIOTECARIO
        ];

        $Bibliotecario = [
            'cpf' => $dados['cpf'],
            'nome' => $dados['nome']
        ];
        $this->UsuarioModel->save($Usuario);
        $this->BibliotecarioModel->save($Bibliotecario);
        return redirect()->to('/suporte');
    }
}