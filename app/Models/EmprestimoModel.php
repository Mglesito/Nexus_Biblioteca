<?php

namespace App\Models;

use CodeIgniter\Model;

class EmprestimoModel extends Model
{
    protected $table            = 'emprestimo';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["id","registro","data_emprestimo","data_devolucao","devolvido","cpf"];

    protected bool $allowEmptyInserts = true;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function listarComDados()
    {
        return $this->select('
                emprestimo.id,
                emprestimo.cpf,
                emprestimo.registro,
                emprestimo.data_emprestimo,
                emprestimo.data_devolucao,
                emprestimo.devolvido,
                aluno.nome AS nome_aluno,
                aluno.turma,
                livro.titulo
            ')
            ->join(
                'aluno',
                'aluno.cpf = emprestimo.cpf',
                'left'
            )
            ->join(
                'livro',
                'livro.registro = emprestimo.registro',
                'left'
            )
            ->orderBy('emprestimo.devolvido', 'ASC')
            ->orderBy('emprestimo.data_devolucao', 'ASC')
            ->findAll();
    }

    /**
     * Verifica se um aluno possui empréstimos ativos (não devolvidos)
     * @param string $cpf CPF do aluno
     * @return int Número de empréstimos ativos
     */
    public function contarEmprestimosAtivos($cpf)
    {
        return $this->where('cpf', $cpf)
            ->where('devolvido', 0)
            ->countAllResults();
    }

    /**
     * Verifica se um aluno tem empréstimo ativo
     * @param string $cpf CPF do aluno
     * @return bool True se tem empréstimo ativo, false caso contrário
     */
    public function temEmprestimoAtivo($cpf)
    {
        return $this->contarEmprestimosAtivos($cpf) > 0;
    }

    public function listarPorAluno($cpf)
    {
        return $this->select('emprestimo.*, livro.titulo, livro.autor')
            ->join('livro', 'livro.registro = emprestimo.registro', 'left')
            ->where('emprestimo.cpf', $cpf)
            ->orderBy('emprestimo.data_emprestimo', 'DESC')
            ->findAll();
    }

    /**
     * Conta quantos alunos têm empréstimos em atraso
     * @return int Número de alunos em atraso
     */
    public function contarAlunosEmAtraso()
    {
        $db = \Config\Database::connect();
        
        $result = $db->table('emprestimo')
            ->select('COUNT(DISTINCT cpf) as total')
            ->where('devolvido', 0)
            ->where('data_devolucao <', date('Y-m-d'))
            ->get()
            ->getRow();
        
        return $result->total ?? 0;
    }

    /**
     * Lista empréstimos em atraso com dados do aluno e livro
     * @return array Empréstimos em atraso
     */
    public function listarEmAtraso()
    {
        return $this->select('
                emprestimo.id,
                emprestimo.cpf,
                emprestimo.registro,
                emprestimo.data_emprestimo,
                emprestimo.data_devolucao,
                emprestimo.devolvido,
                aluno.nome AS nome_aluno,
                aluno.turma,
                livro.titulo
            ')
            ->join('aluno', 'aluno.cpf = emprestimo.cpf', 'left')
            ->join('livro', 'livro.registro = emprestimo.registro', 'left')
            ->where('emprestimo.devolvido', 0)
            ->where('emprestimo.data_devolucao <', date('Y-m-d'))
            ->orderBy('emprestimo.data_devolucao', 'ASC')
            ->findAll();
    }
}
