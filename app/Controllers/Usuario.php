<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
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
                 ->select('idUser, name, user, email, active, null as acao');

            $usuarioFiltrar = $this->request->getGet('usuarioFiltrar');
            $nomeFiltrar = $this->request->getGet('nomeFiltrar');
            $statusFiltrar = $this->request->getGet('statusFiltrar');

            if (!empty($usuarioFiltrar)) {
                $this->usuarioModel->where('user', $usuarioFiltrar);
            }

            if (!empty($nomeFiltrar)) {
                $this->usuarioModel->where('name', $nomeFiltrar);
            }

            if (in_array($statusFiltrar, ['0', '1'])) {
                $this->usuarioModel->where('active', $statusFiltrar);
            }

            $rows = $this->usuarioModel->findAll();

            $data['recordsTotal'] = count($rows);
            $data['recordsFiltered'] = count($rows);

            foreach ($rows as $row) {
                $data['data'][] = [
                    $row->idUser,
                    $row->name,
                    $row->user,
                    $row->email,
                    ($row->active) ? '<span class="badge bg-success">ATIVO</span>' : '<span class="badge bg-danger">INATIVO</span>',
                    '<button type="button" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>'
                ];
            }
            return $this->response->setJSON($data);
        }
        // TODO RETORNA NA PÁGINA 404 PARA ERRO
        return view("pages/usuario/index", $data);
    }
}
