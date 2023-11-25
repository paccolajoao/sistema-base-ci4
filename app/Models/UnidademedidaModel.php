<?php

namespace App\Models;

use CodeIgniter\Model;

class UnidademedidaModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'unidadesmedida';
    protected $primaryKey = 'idUnidadeMedida';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $protectFields = false;
    protected $allowedFields = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getUnidadesMedida(array $filter)
    {

        $this->select('idUnidadeMedida,
                             nome,
                             isRelacional,
                             ativo, 
                             null as acao');

        if (!empty($filter['nome'])) {
            $this->like('nome', $filter['nome']);
        }

        if ((!empty($filter['isRelacional']) && $filter['isRelacional'] != 'all') ||
            in_array($filter['isRelacional'], ['0', '1'])) {
            $this->where('isRelacional', $filter['isRelacional']);
        }

        if ((!empty($filter['ativo']) && $filter['ativo'] != 'all') ||
            in_array($filter['ativo'], ['0', '1'])) {
            $this->where('ativo', $filter['ativo']);
        }

        if (!empty($filter['idUnidadeMedida'])) {

            $this->select('umr.idUnidadeMedidaBase as UMBase,
                                 umr.quantidade');
            $this->join('unidadesmedida_relacional as umr', 'umr.idUnidadeMedidaRelacional = idUnidadeMedida', 'left');

            $this->where('idUnidadeMedida', $filter['idUnidadeMedida']);
            return $this->findAll()[0];
        }

        return $this->findAll();

    }

    public function createUnidadesMedida($data)
    {
        // Inicio da transaction
        $this->db->transBegin();

        // monto o vetor com a um
        $insertUM = [
            'nome' => $data['nome'],
            'isRelacional' => $data['isRelacional'],
            'ativo' => $data['ativo'],
            'updated_at' => $data['updated_at'],
            'idUnidadeMedida' => $data['idUnidadeMedida'] ?? ''
        ];
        $this->db->table('unidadesmedida')->upsert($insertUM);
        if (!empty($data['idUnidadeMedida'])) {
            $idUM = $data['idUnidadeMedida'];
        } else {
            $idUM = $this->db->insertID();
        }

        // se for relacional, insiro as relações
        $this->db->table('unidadesmedida_relacional')
            ->where('idUnidadeMedidaRelacional', $idUM)
            ->delete();
        if ($data['isRelacional'] == '1') {
            $insertUMRelacional = [
                'idUnidadeMedidaRelacional' => $idUM,
                'idUnidadeMedidaBase' => $data['idUnidadeMedidaBase'],
                'quantidade' => $data['quantidade'],
                'updated_at' => $data['updated_at']
            ];
            $this->db->table('unidadesmedida_relacional')->insert($insertUMRelacional);
        }

        // realiza a transaction ou faz rollback
        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }

    public function getUMCompleto ($idUnidadeMedida) {
        $this->select();
        $this->select('umr.idUnidadeMedidaBase as UMBase,
                                 umr.quantidade');
        $this->join('unidadesmedida_relacional as umr', 'umr.idUnidadeMedidaRelacional = idUnidadeMedida', 'left');
        $this->where('idUnidadeMedida', $idUnidadeMedida);
        return $this->findAll()[0];
    }

    public function deleteUnidadeMedida ($idUnidadeMedida) {
        $this->where('idUnidadeMedida', $idUnidadeMedida);
        $this->delete();
    }
}
