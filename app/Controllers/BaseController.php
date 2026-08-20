<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // $this->session = service('session');
    }

    /**
     * Verifica se o usuário está autenticado como bibliotecário
     * Se não estiver, redireciona para login
     */
    protected function verificarBibliotecario()
    {
        if (session()->get('logado') !== true || session()->get('tipo_usuario') != 2) {
            return redirect()->to('/login');
        }

        return null;
    }

    /**
     * Verifica se o usuário está autenticado como aluno
     * Se não estiver, redireciona para login
     */
    protected function verificarAluno()
    {
        if (session()->get('logado') !== true || session()->get('tipo_usuario') != 1) {
            return redirect()->to('/login');
        }

        return null;
    }

    /**
     * Verifica se o usuário está autenticado como suporte
     * Se não estiver, redireciona para login
     */
    protected function verificarSuporte()
    {
        if (session()->get('logado') !== true || session()->get('tipo_usuario') != 3) {
            return redirect()->to('/login');
        }

        return null;
    }
}
