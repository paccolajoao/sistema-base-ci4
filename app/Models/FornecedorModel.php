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

    /**
     * Retorna todos os produtos relacionados ao fornecedor
     * @return array|mixed
     */
    public function getFornecedorProdutos ($idFornecedor = null) {
        $qry = $this->db->table('produtos as prd')
                        ->select('prd.idProduto as idProduto, 
                                        prdf.idProdutoFornecedor as idProdutoFornecedor,
                                        prd.codigo as codProduto,
                                        prd.nome as nomeProduto,
                                        null as acao')
                        ->join('produtos_fornecedores as prdf', 'prd.idProduto = prdf.idProduto', 'inner')
                        ->where('prd.ativo', 1)
                        ->where('prdf.idFornecedor', $idFornecedor)
                        ->get();

        return $qry->getResultObject();
    }

    public function createFornecedor ($data) {
        $this->upsert($data);
    }

    public function createFornecedorProduto ($data) {
        $this->db->table('produtos_fornecedores')
                 ->upsert($data);
    }

    public function getFornecedorCompleto ($idFornecedor) {
        $this->select();
        $this->where('idFornecedor', $idFornecedor);
        return $this->findAll()[0];
    }

    public function deleteFornecedor ($idFornecedor) {
        $this->where('idFornecedor', $idFornecedor);
        $this->delete();
    }

    public function getDeletedProdutoFornecedor ($idProdutoFornecedor) {
        $qry = $this->db
                 ->table('produtos_fornecedores')
                 ->select()
                 ->where('idProdutoFornecedor', $idProdutoFornecedor)
                 ->get();
        return $qry->getRowArray();
    }

    public function deleteProdutoFornecedor ($idProdutoFornecedor) {
        $this->db
                 ->table('produtos_fornecedores')
                 ->where('idProdutoFornecedor', $idProdutoFornecedor)
                 ->delete();
    }
}
