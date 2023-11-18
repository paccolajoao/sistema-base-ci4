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

    public function add($idUser = null)
    {
        $data['title'] = ucfirst("adicionar usuário");
        // se tiver um id de usuário, é editar, então tras os dados na tela
        if (!empty($idUser)) {
            $filter = [
                'idUser' => $idUser,
                'status' => 'all'
            ];
            $data['usuario'] = $this->usuarioModel->getUsers($filter);
        }
        return view("pages/usuario/add", $data);
    }

    /**
     * Função para criar ou alterar um usuário
     * @param $idUser
     * @return false|string
     */

    public function createUser($idUser = null)
    {
        if ($this->request->isAJAX()) {
            // Removo todos os campos que vem vazio
            array_filter($this->request->getVar());

            // Validação
            if (empty($idUser) && !$this->validate('userRules')) {
                // The validation failed.
                $return = ['msg' => 'error', 'error' => $this->validator->getErrors()];
                return json_encode($return);
            } else if (!$this->validate('userUpdateRules')){
                $return = ['msg' => 'error', 'error' => $this->validator->getErrors()];
                return json_encode($return);
            }

            // Recebo os dados
            $data = $this->validator->getValidated();

            // Salvo a imagem no servidor
            $img = $this->request->getFile('foto_perfil');
            if (!$img->hasMoved() && $img->isValid()) {
                $fileName = $img->getRandomName();
                $img->store('../../public/assets/img_user', $fileName);
            }

            // Se for editar e o password estiver em branco, não altero o password
            if (!empty($idUser) && empty($data['password'])) {
                $data['idUser'] = $idUser;
                unset($data['password']);
            } else {
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            }

            $data['active'] = $data['status'] ? 1 : 0;
            $data['status'] = $data['status'] ? 'ATIVO' : 'INATIVO';
            $data['updated_at'] = date("Y-m-d H:i:s");
            $data['profilePicture'] = !empty($fileName) ? $fileName : '';
            unset($data['pass_conference']);

            // construo o vetor para salvar os logs
            $logParams = [
              "guid" => getGUID(),
              "data" => date("Y-m-d H:i:s"),
              "controller" => $this->router->controllerName(),
              "metodo" => $this->router->methodName(),
              "dados" => json_encode($data),
              "tabela" => 'usuario',
              "operacao" => empty($idUser) ? 'i' : 'u'
            ];
            try {
                $this->usuarioModel->createUser($data);
                $logParams['isError'] = false;
                $return = ['msg' => 'success'];
            } catch (DatabaseException $e) {
                $logParams['isError'] = true;
                $logParams['erroTexto'] = $e->getMessage();
                $return = ['msg' => 'error', 'error' => $e->getMessage()];
            }
            $this->logs->save($logParams);
            return json_encode($return);
        } else {
            return view("pages/errors/erro404");
        }
    }

    /**
     * Função para deletar um usuário
     * @param $idUser
     * @return false|string
     */
    public function deleteUser($idUser = null)
    {
        if ($this->request->isAJAX()) {
            // construo o vetor para salvar os logs
            $logParams = [
                "guid" => getGUID(),
                "data" => date("Y-m-d H:i:s"),
                "controller" => $this->router->controllerName(),
                "metodo" => $this->router->methodName(),
                "dados" => $this->getDeletedUser($idUser),
                "tabela" => 'usuario',
                "operacao" => 'd'
            ];
            try {
                $this->usuarioModel->deleteUser($idUser);
                $logParams['isError'] = false;
                $return = ['msg' => 'success'];
            } catch (DatabaseException $e) {
                $logParams['isError'] = true;
                $logParams['erroTexto'] = $e->getMessage();
                $return = ['msg' => 'error', 'error' => $e->getMessage()];
            }
            $this->logs->save($logParams);
            return json_encode($return);
        } else {
            return view("pages/errors/erro404");
        }
    }

    public function getDeletedUser($idUser) {
        $ret = $this->usuarioModel
                    ->getUserCompleto($idUser);
        return json_encode($ret);
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
                    '
                        <button type="button" class="btn btn-sm btn-primary editar-usuario" data-id="' . (int)$row->idUser . '"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="button" class="btn btn-sm btn-danger excluir-usuario" data-id="' . (int)$row->idUser . '"><i class="fa-solid fa-trash-can"></i></button>
                    '
                ];
            }
            return json_encode($data);
        }
        return view("pages/errors/erro404");
    }
}
