<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\LeitoresController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmprestimoModel;
use App\Models\HistoricoModel;
use App\Models\AlunoModel;
use App\Models\LivroModel;
use App\Controllers\CadastroAlunoController;

class DashboardEmprestimoBibliotecarioController extends BaseController
{
    private $EmprestimoModel;
    private $HistoricoModel;
    private $AlunoModel;
    private $LivroModel;

    public function __construct(){
        $this->EmprestimoModel = new EmprestimoModel();
        $this->HistoricoModel = new HistoricoModel();
        $this->AlunoModel = new AlunoModel();
        $this->LivroModel = new LivroModel();
    }
    public function index()
    {
        $this->verificarBibliotecario();

        $Emprestimos = $this->EmprestimoModel->listarComDados();

        return view('emprestimo/emprestimos', [
            'Emprestimos' => $Emprestimos
        ]);
    }

    public function listar(){
        return $this->EmprestimoModel->findAll();
    }

    public function salvar(){
        if ($redirect = $this->verificarBibliotecario()) {
            return $redirect;
        }

        $Emprestimo = $this->request->getPost();
        $cpfAluno = $Emprestimo['cpf'] ?? null;
        $registroLivro = $Emprestimo['registro'] ?? null;

        // Verificar se o aluno já tem um empréstimo ativo
        if ($cpfAluno && $this->EmprestimoModel->temEmprestimoAtivo($cpfAluno)) {
            return redirect()->back()
                ->with('erro', 'Este aluno já possui um empréstimo ativo. É necessário devolver o livro anterior antes de fazer um novo empréstimo.');
        }

        $dataDevolucao = date('Y-m-d', strtotime('+7 days'));
        $Emprestimo['data_devolucao'] = $dataDevolucao;
        $Emprestimo['devolvido'] = 0;
        $this->EmprestimoModel->save($Emprestimo);
        $this->LivroModel->where('registro', $registroLivro)->set(['emprestado' => 1])->update();

        // Buscar dados do aluno e livro para o histórico
        $aluno = $this->AlunoModel->find($cpfAluno);
        $livro = $this->LivroModel->where('registro', $registroLivro)->first();

        // Registrar no histórico
        $this->HistoricoModel->registrarAcao(
            'EMPRESTIMO',
            $cpfAluno,
            $aluno['nome'] ?? 'Desconhecido',
            $registroLivro,
            $livro['titulo'] ?? 'Desconhecido',
            'Livro emprestado'
        );

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
        if ($redirect = $this->verificarBibliotecario()) {
            return $redirect;
        }

        $this->EmprestimoModel->delete($id);
        return redirect()->to('/bibliotecario/emprestimos');
    }

    /**
     * Registra a devolução de um livro
     */
    public function devolver($id)
    {
        if ($redirect = $this->verificarBibliotecario()) {
            return $redirect;
        }

        $emprestimo = $this->EmprestimoModel->find($id);
        
        if (!$emprestimo) {
            return redirect()->back()->with('erro', 'Empréstimo não encontrado.');
        }

        // Atualizar o empréstimo como devolvido
        $this->EmprestimoModel->update($id, ['devolvido' => 1]);
        $this->LivroModel->where('registro', $emprestimo['registro'])->set(['emprestado' => 0])->update();

        // Buscar dados do aluno e livro para o histórico
        $aluno = $this->AlunoModel->find($emprestimo['cpf']);
        $livro = $this->LivroModel->where('registro', $emprestimo['registro'])->first();

        // Registrar no histórico
        $this->HistoricoModel->registrarAcao(
            'DEVOLUCAO',
            $emprestimo['cpf'],
            $aluno['nome'] ?? 'Desconhecido',
            $emprestimo['registro'],
            $livro['titulo'] ?? 'Desconhecido',
            'Livro devolvido'
        );

        return redirect()->to('/bibliotecario/emprestimos');
    }

    /**
     * Adiciona 7 dias à data de devolução do empréstimo
     */
    public function adicionarDias($id)
    {
        if ($redirect = $this->verificarBibliotecario()) {
            return $redirect;
        }

        $emprestimo = $this->EmprestimoModel->find($id);
        
        if (!$emprestimo) {
            return redirect()->back()->with('erro', 'Empréstimo não encontrado.');
        }

        if ($emprestimo['devolvido'] == 1) {
            return redirect()->back()->with('erro', 'Não é possível renovar um empréstimo já devolvido.');
        }

        // Calcular nova data: adicionar 7 dias à data de devolução atual
        $novaDataDevolucao = date('Y-m-d', strtotime($emprestimo['data_devolucao'] . ' +7 days'));

        // Atualizar o empréstimo com a nova data
        $this->EmprestimoModel->update($id, ['data_devolucao' => $novaDataDevolucao]);

        // Buscar dados do aluno e livro para o histórico
        $aluno = $this->AlunoModel->find($emprestimo['cpf']);
        $livro = $this->LivroModel->where('registro', $emprestimo['registro'])->first();

        // Registrar no histórico
        $this->HistoricoModel->registrarAcao(
            'RENOVACAO',
            $emprestimo['cpf'],
            $aluno['nome'] ?? 'Desconhecido',
            $emprestimo['registro'],
            $livro['titulo'] ?? 'Desconhecido',
            'Empréstimo renovado por 7 dias (nova devolução: ' . $novaDataDevolucao . ')'
        );

        return redirect()->to('/bibliotecario/emprestimos');
    }
}
