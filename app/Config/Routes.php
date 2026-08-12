<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'LoginController::index');
$routes->post('/login/verificar_usuario', 'LoginController::verificar_usuario');
$routes->get('/login/deslogar', 'LoginController::deslogar');

$routes->get('/aluno/dashboard', 'DashboardAlunoController::index');
$routes->get('/aluno/catalogo', 'CatalogoController::index');
$routes->get('/aluno/emprestimo', 'EmprestimoAlunoController::index');


$routes->get('/bibliotecario/dashboard', 'DashboardBibliotecarioController::index');
$routes->get('/bibliotecario/acervo', 'AcervoController::index');
$routes->get('/bibliotecario/dashboard_emprestimo', 'DashboardEmprestimoBibliotecarioController::index');
$routes->get('/bibliotecario/cadastro_aluno', 'CadastroAlunoController::index');
$routes->get('/bibliotecario/historico', 'HistoricoController::index');
$routes->get('/bibliotecario/leitores', 'LeitoresController::index');
$routes->get('/bibliotecario/modal', 'ModalController::index');
$routes->get('/bibliotecario/tombo', 'TomboController::index');
$routes->get('/suporte', 'SuporteController::index');
$routes->setAutoRoute(true);
