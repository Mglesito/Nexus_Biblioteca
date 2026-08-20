<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsuarioModel;

class LoginController extends BaseController
{
    private $usuarioModel;
    public function __construct(){
        $this->usuarioModel = new UsuarioModel();
    }
    public function index()
    {
        return view('login/login-aluno');
    }

    public function listar(){
        $usuarios = $this->usuarioModel->findAll();
        return $usuarios;
    }

    public function procurar($id){
        $usuario = $this->usuarioModel->find($id);
        return $usuario;
    }

    public function verificar_usuario(){
        $cpf = $this->request->getPost('cpf');
        $senha = $this->request->getPost('senha');
        if($this->procurar($cpf) === null){
            return redirect()->to('/login')->with('error', 'Este usuario não existe.');
        }else{
             return $this->logar($cpf,$senha);
        }
    }

    public function logar($cpf,$senha){
        $usuario = $this->procurar($cpf);
        $senhaValida = password_verify($senha, $usuario['senha']);

        // Compatibilidade temporária com usuários cadastrados antes do hash.
        if (!$senhaValida && hash_equals((string) $usuario['senha'], (string) $senha)) {
            $senhaValida = true;
            $this->usuarioModel->update($usuario['cpf'], ['senha' => $senha]);
        }

        if($usuario['cpf'] == $cpf && $senhaValida){
            $dadosUsuario = ['cpf' => $usuario['cpf'],'logado'=> true,'tipo_usuario'=> $usuario['tipo_usuario']];
            session()->set($dadosUsuario);
            return redirect()->to('/');
        }else{
            return redirect()->to('/login')->with('error', 'Credenciais de Login Inválidas.');
        }
    }

    public function deslogar(){
        session()->destroy();
        return redirect()->to('/');
    }

    public function salvar($Aluno){
        $this->usuarioModel->save($Aluno);
    }
}
