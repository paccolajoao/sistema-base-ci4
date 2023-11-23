<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Database;
use Psr\Log\LoggerInterface;

class CreateSelect2 extends BaseController
{
    private $db;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->db = Database::connect();
    }

    public function select2Cidades()
    {
        $builder = $this->db->table('cidade as c');
        $builder->select('c.idCidade as id, 
                          CONCAT(c.nome, " - ", e.uf)  as text');
        $builder->join('estado as e', 'c.uf = e.idEstado');
        if (!empty($this->request->getVar('search'))) {
            $builder->like('c.nome', $this->request->getVar('search'));
        }
        if (!empty($this->request->getVar('ibge'))) {
            $builder->where('c.ibge', $this->request->getVar('ibge'));
        }
        if (!empty($this->request->getVar('idCidade'))) {
            $builder->where('c.idCidade', $this->request->getVar('idCidade'));
        }
        $builder->orderBy('c.nome', '');
        $query = $builder->get()->getResult('array');
        return json_encode($query);
    }
}
