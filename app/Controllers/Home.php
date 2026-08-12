<?php
namespace App\Controllers;
class Home extends BaseController
{
    public function index()
    {
        if (session()->get('logado') !== true) {
            return redirect()->to('/login');
        }

        switch (session()->get('tipo_usuario')) {
            case '1':
                return redirect()->to('/aluno/dashboard');

            case '2':
                return redirect()->to('/bibliotecario/dashboard');

            case '3':
                return redirect()->to('/suporte');

            default:
                session()->destroy();
                return redirect()->to('/login');
        }
    }
}