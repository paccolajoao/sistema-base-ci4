<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

    protected $table = 'user';
    protected $primaryKey = 'idUser';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false; // true, se eu quiser mostrar apenas os usuários ativos
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'password', 'name', 'email', 'status', 'profilePicture'];

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

    public function getUsers(array $filter) {

        $this->select('idUser,
                             name,
                             username,
                             email,
                             active, 
                             null as acao');

        if (!empty($filter['usuario'])) {
            $this->like('username', $filter['usuario']);
        }

        if (!empty($filter['nome'])) {
            $this->like('name', $filter['nome']);
        }

        if (in_array($filter['status'], ['0', '1'])) {
            $this->where('active', $filter['status'],);
        }

        return $this->findAll();

    }

    public function createUser($data) {
        $this->insert($data);
    }

}