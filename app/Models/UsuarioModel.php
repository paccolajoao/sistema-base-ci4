<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

    protected $table = 'usuario';
    protected $primaryKey = 'idUser';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $useSoftDeletes = false; // true, se eu quiser mostrar apenas os usuários ativos
    protected $protectFields    = true;
    protected $allowedFields    = ['idUser', 'username', 'password', 'name', 'email', 'status', 'profilePicture', 'active'];

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

        if ( (!empty($filter['status']) && $filter['status'] != 'all') ||
             in_array($filter['status'], ['0', '1']))
        {
            $this->where('active', $filter['status']);
        }

        if (!empty($filter['idUser'])) {
            $this->where('idUser', $filter['idUser']);
            return $this->findAll()[0];
        }

        return $this->findAll();

    }

    public function createUser($data) {
        $this->upsert($data);
    }

    public function getUserCompleto($idUser) {
        $this->select();
        $this->where('idUser', $idUser);
        return $this->findAll()[0];
    }

    public function deleteUser($idUser) {
        $this->where('idUser', $idUser);
        $this->delete();
    }

}