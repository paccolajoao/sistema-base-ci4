<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Usuario extends BaseController
{
    private UsuarioModel $usuarioModel;

    public function initController(
        RequestInterface  $request,
        ResponseInterface $response,
        LoggerInterface   $logger
    )
    {
        parent::initController($request, $response, $logger);

        // Models
        $this->usuarioModel = model('UsuarioModel');
    }

    public function index()
    {
        $data['title'] = ucfirst("usuários");
        return view("pages/usuario/index", $data);
    }

    public function add()
    {
        $data['title'] = ucfirst("adicionar usuário");
        return view("pages/usuario/add", $data);
    }


    public function createUser()
    {
        if ($this->request->isAJAX()) {
            // Validação
            if (!$this->validate('userRules')) {
                // The validation failed.
                $return = ['msg' => 'error', 'error' => $this->validator->getErrors()];
                return json_encode($return);
            }

            // Recebo os dados
            $data = $this->validator->getValidated();
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            $data['status'] = $data['status'] ? 'ATIVO' : 'INATIVO';
            unset($data['pass_conference']);
            try {
                $this->usuarioModel->createUser($data);
                $return = ['msg' => 'success'];
            } catch (DatabaseException $e) {
                $return = ['msg' => 'error', 'error' => $e->getMessage()];
            }
            return json_encode($return);
        } else {
            return view("pages/errors/erro404");
        }
    }

    /**
     * [AJAX] Função retorna os usuários filtrados
     */
    public function getUsers()
    {
        if ($this->request->isAJAX()) {
            $data = [
                "draw" => $this->request->getGet('draw'),
                "recordsTotal" => 1,
                "recordsFiltered" => 1,
                "data" => []
            ];

            $this->usuarioModel
                 ->select('idUser, name, username, email, active, null as acao');

            $usuarioFiltrar = $this->request->getGet('usuarioFiltrar');
            $nomeFiltrar = $this->request->getGet('nomeFiltrar');
            $statusFiltrar = $this->request->getGet('statusFiltrar');
            $search = trim((string) $this->request->getGet('search')['value']);

            if (!empty($usuarioFiltrar)) {
                $this->usuarioModel->where('username', $usuarioFiltrar);
            }

            if (!empty($nomeFiltrar)) {
                $this->usuarioModel->where('name', $nomeFiltrar);
            }

            if (in_array($statusFiltrar, ['0', '1'])) {
                $this->usuarioModel->where('active', $statusFiltrar);
            }

            if (!empty($search)) {
                $this->usuarioModel->where("CONCAT(idUser     , ' ', 
                                                       name       , ' ',
                                                       username   , ' ',
                                                       email      , ' ',
                                                       active     , ' ') LIKE '%{$search}%'");
            }

            $rows = $this->usuarioModel->findAll();

            $data['recordsTotal'] = count($rows);
            $data['recordsFiltered'] = count($rows);

            foreach ($rows as $row) {
                $data['data'][] = [
                    $row->idUser,
                    $row->name,
                    $row->username,
                    $row->email,
                    ($row->active) ? '<span class="badge bg-success">ATIVO</span>' : '<span class="badge bg-danger">INATIVO</span>',
                    '<button type="button" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>'
                ];
            }
            return $this->response->setJSON($data);
        }
        return view("pages/errors/erro404");
    }
}
