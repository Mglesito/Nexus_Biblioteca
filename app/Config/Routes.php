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
$routes->get('/bibliotecario/modal', 'ModalController::index');


$routes->get('/bibliotecario/dashboard', 'DashboardBibliotecarioController::index');
$routes->get('/bibliotecario/acervo', 'AcervoController::index');
$routes->get('/bibliotecario/emprestimos', 'DashboardEmprestimoBibliotecarioController::index');
    $routes->post('/bibliotecario/emprestimos/salvar', 'DashboardEmprestimoBibliotecarioController::salvar');
    $routes->get('/bibliotecario/emprestimos/devolver/(:segment)', 'DashboardEmprestimoBibliotecarioController::devolver/$1');
    $routes->get('/bibliotecario/emprestimos/adicionarDias/(:segment)', 'DashboardEmprestimoBibliotecarioController::adicionarDias/$1');
$routes->get('/bibliotecario/cadastro_aluno', 'CadastroAlunoController::index');
    $routes->post('/bibliotecario/cadastro_aluno/salvar', 'CadastroAlunoController::salvar');
$routes->get('/bibliotecario/historico', 'HistoricoController::index');
$routes->get('/bibliotecario/leitores', 'LeitoresController::index');
$routes->get('/bibliotecario/modal', 'ModalController::index');
$routes->get('/bibliotecario/livros', 'LivroController::index');
    $routes->post('/bibliotecario/livros/salvar', 'LivroController::salvar');
$routes->get('/bibliotecario/tombo', 'TomboController::index');
    $routes->post('/bibliotecario/tombo/salvar', 'TomboController::salvar');
    $routes->get('/bibliotecario/tombo/editar/(:segment)', 'TomboController::editar/$1');
    $routes->get('/bibliotecario/tombo/excluir/(:segment)', 'TomboController::excluir/$1');

$routes->get('/suporte', 'SuporteController::index');
    $routes->post('/suporte/salvar', 'SuporteController::salvar');
$routes->setAutoRoute(true);