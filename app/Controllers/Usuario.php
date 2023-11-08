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

            // Salvo a imagem no servidor
            $img = $this->request->getFile('foto_perfil');
            if (! $img->hasMoved() && $img->isValid()) {
                $pathFile = $img->store('user_img');
            }

            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            $data['status'] = $data['status'] ? 'ATIVO' : 'INATIVO';
            $data['profilePicture'] = !empty($pathFile) ? $pathFile : '';
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
            $usuarioFiltrar = $this->request->getVar('usuarioFiltrar');
            $nomeFiltrar    = $this->request->getVar('nomeFiltrar');
            $statusFiltrar  = $this->request->getVar('statusFiltrar');

            $filter = [
                'usuario' => $usuarioFiltrar,
                'nome' => $nomeFiltrar,
                'status' => $statusFiltrar
            ];

            $ret = $this->usuarioModel
                        ->getUsers($filter);

            $data['data'] = [];
            foreach ($ret as $row) {
                $data['data'][] = [
                    (int)$row->idUser,
                    $row->name,
                    $row->username,
                    $row->email,
                    ($row->active)
                        ? '<span class="badge bg-success">ATIVO</span>'
                        : '<span class="badge bg-danger">INATIVO</span>',
                    '<button type="button" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>'
                ];
            }
            return json_encode($data);
        }
        return view("pages/errors/erro404");
    }
}
