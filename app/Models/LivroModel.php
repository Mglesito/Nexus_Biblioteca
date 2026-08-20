<?php

namespace App\Models;

use CodeIgniter\Model;

class LivroModel extends Model
{
    protected $table            = 'livro';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["id","registro","autor","titulo","exemplar","status","emprestado"];

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

    /**
     * Conta o total de livros cadastrados
     */
    public function totalLivros()
    {
        return $this->countAllResults();
    }

    /**
     * Conta livros disponíveis (não emprestados)
     */
    public function livrosDisponiveis()
    {
        return $this->where('emprestado', 0)->countAllResults();
    }

    /**
     * Conta livros emprestados
     */
    public function livrosEmprestados()
    {
        return $this->where('emprestado', 1)->countAllResults();
    }

    public function listarDisponiveis()
    {
        return $this->where('emprestado', 0)
            ->orderBy('titulo', 'ASC')
            ->findAll();
    }
}
