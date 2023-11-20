<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'produtos';
    protected $primaryKey       = 'idProduto';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idProduto', 'nome', 'codigo', 'controla_estoque', 'ativo', 'created_at', 'updated_at'];

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

    public function getProdutos (array $filter) {

        $this->select('idProduto,
                             nome,
                             codigo,
                             controla_estoque,
                             observacoes,
                             ativo, 
                             null as acao');

        if (!empty($filter['nome'])) {
            $this->like('nome', $filter['nome']);
        }

        if (!empty($filter['codigo'])) {
            $this->like('codigo', $filter['codigo']);
        }

        if ( (!empty($filter['status']) && $filter['status'] != 'all') ||
            in_array($filter['status'], ['0', '1']))
        {
            $this->where('ativo', $filter['status']);
        }

        if (!empty($filter['idProduto'])) {
            $this->where('idProduto', $filter['idProduto']);
            return $this->findAll()[0];
        }

        return $this->findAll();

    }

    public function createProduto ($data) {
        $this->upsert($data);
    }

    public function getProdutoCompleto ($idProduto) {
        $this->select();
        $this->where('idProduto', $idProduto);
        return $this->findAll()[0];
    }

    public function deleteProduto ($idProduto) {
        $this->where('idProduto', $idProduto);
        $this->delete();
    }
}
