<?php

namespace App\Controllers;

use App\Models\FornecedorModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Fornecedor extends BaseController
{
    private FornecedorModel $fornecedorModel;

    public function initController(
        RequestInterface  $request,
        ResponseInterface $response,
        LoggerInterface $logger
    )
    {
        parent::initController($request, $response, $logger);

        // Models
        $this->fornecedorModel = new FornecedorModel();
    }

    public function index()
    {
        $data['title'] = ucfirst("fornecedores");
        return view("pages/fornecedores/index", $data);
    }

    /**
     * [AJAX] Função retorna os fornecedores filtrados
     */
    public function getFornecedores()
    {
        if ($this->request->isAJAX()) {
            $razaoSocialFiltrar = $this->request->getVar('razaoSocialFiltrar');
            $codigoFiltrar    = $this->request->getVar('codigoFiltrar');
            $statusFiltrar  = $this->request->getVar('statusFiltrar');
            $tipoFiltrar  = $this->request->getVar('tipoFiltrar');

            $filter = [
                'razao_social' => $razaoSocialFiltrar,
                'codigo' => $codigoFiltrar,
                'status' => $statusFiltrar,
                'tipo' => $tipoFiltrar
            ];

            $ret = $this->fornecedorModel
                        ->getFornecedores($filter);

            $data['data'] = [];
            foreach ($ret as $row) {
                $data['data'][] = [
                    (int)$row->idFornecedor,
                    $row->codigo,
                    $row->razao_social,
                    ($row->tipo == 1)
                        ? '<span class="badge bg-primary">PESSOA JURÍDICA</span>'
                        : '<span class="badge bg-warning text-dark">PESSOA FÍSICA</span>',
                    ($row->ativo)
                        ? '<span class="badge bg-success">ATIVO</span>'
                        : '<span class="badge bg-danger">INATIVO</span>',
                    '
                        <button type="button" class="btn btn-sm btn-primary editar-registro" data-id="' . (int)$row->idFornecedor . '"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="button" class="btn btn-sm btn-danger excluir-registro" data-id="' . (int)$row->idFornecedor . '"><i class="fa-solid fa-trash-can"></i></button>
                    '
                ];
            }
            return json_encode($data);
        }
        return view("pages/errors/erro404");
    }

    public function add($idFornecedor = null)
    {
        $data['title'] = ucfirst("adicionar fornecedor");
        // se tiver um id de usuário, é editar, então tras os dados na tela
        if (!empty($idFornecedor)) {
            $filter = [
                'idProduto' => $idFornecedor,
                'status' => 'all',
                'tipo' => 'all'
            ];
            $data['produto'] = $this->fornecedorModel->getFornecedores($filter);
        }
        return view("pages/fornecedores/add", $data);
    }

    public function createFornecedor($idFornecedor = null)
    {
        if ($this->request->isAJAX()) {
            // Removo todos os campos que vem vazio
            array_filter($this->request->getVar());

            // Validação
            if (!$this->validate('fornecedorRules')) {
                // The validation failed.
                $return = ['msg' => 'error', 'error' => $this->validator->getErrors()];
                return json_encode($return);
            }

            // Recebo os dados
            $data = $this->validator->getValidated();

            //Editar
            if (!empty($idFornecedor)) {
                $data['idFornecedor'] = $idFornecedor;
            }
            $data['updated_at'] = date("Y-m-d H:i:s");

            // construo o vetor para salvar os logs
            $logParams = [
                "guid" => getGUID(),
                "data" => date("Y-m-d H:i:s"),
                "controller" => $this->router->controllerName(),
                "metodo" => $this->router->methodName(),
                "dados" => json_encode($data),
                "tabela" => 'fornecedores',
                "idUsuario" => infoUsuarioLogado()->idUser,
                "operacao" => empty($idFornecedor) ? 'i' : 'u'
            ];
            try {
                $this->fornecedorModel->createFornecedor($data);
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
}