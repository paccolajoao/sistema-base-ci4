<?php

namespace App\Models;

use CodeIgniter\Model;

class FornecedorModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'fornecedores';
    protected $primaryKey       = 'idFornecedor';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = true;
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

    public function getFornecedores (array $filter) {

        $this->select('*, 
                             null as acao');

        if (!empty($filter['razao_social'])) {
            $this->like('razao_social', $filter['razao_social']);
        }

        if (!empty($filter['codigo'])) {
            $this->like('codigo', $filter['codigo']);
        }

        if ( (!empty($filter['status']) && $filter['status'] != 'all') ||
            in_array($filter['status'], ['0', '1']))
        {
            $this->where('ativo', $filter['status']);
        }

        if ( (!empty($filter['tipo']) && $filter['tipo'] != 'all') ||
            in_array($filter['tipo'], ['1', '2']))
        {
            $this->where('tipo', $filter['tipo']);
        }

        if (!empty($filter['idFornecedor'])) {
            $this->where('idFornecedor', $filter['idFornecedor']);
            return $this->findAll()[0];
        }

        return $this->findAll();

    }

    public function createFornecedor ($data) {
        $this->upsert($data);
    }
}
