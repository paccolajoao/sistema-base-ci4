<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdutoModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Produto extends BaseController
{
    private ProdutoModel $produtoModel;

    public function initController(
        RequestInterface  $request,
        ResponseInterface $response,
        LoggerInterface $logger
    )
    {
        parent::initController($request, $response, $logger);

        // Models
        $this->produtoModel = model('ProdutoModel');
    }

    public function index()
    {
        $data['title'] = 'Produtos';
        return view("pages/produtos/index", $data);
    }

    /**
     * [AJAX] Função retorna os produtos filtrados
     */
    public function getProdutos()
    {
        if ($this->request->isAJAX()) {
            $nomeFiltrar = $this->request->getVar('nomeFiltrar');
            $codigoFiltrar    = $this->request->getVar('codigoFiltrar');
            $statusFiltrar  = $this->request->getVar('statusFiltrar');

            $filter = [
                'nome' => $nomeFiltrar,
                'codigo' => $codigoFiltrar,
                'status' => $statusFiltrar
            ];

            $ret = $this->produtoModel
                        ->getProdutos($filter);

            $data['data'] = [];
            foreach ($ret as $row) {
                $data['data'][] = [
                    (int)$row->idProduto,
                    $row->codigo,
                    $row->nome,
                    ($row->controla_estoque)
                        ? '<span class="badge bg-success">SIM</span>'
                        : '<span class="badge bg-danger">NÃO</span>',
                    ($row->ativo)
                        ? '<span class="badge bg-success">ATIVO</span>'
                        : '<span class="badge bg-danger">INATIVO</span>',
                    '
                        <button type="button" class="btn btn-sm btn-primary editar-registro" data-id="' . (int)$row->idProduto . '"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="button" class="btn btn-sm btn-danger excluir-registro" data-id="' . (int)$row->idProduto . '"><i class="fa-solid fa-trash-can"></i></button>
                    '
                ];
            }
            return json_encode($data);
        }
        return view("pages/errors/erro404");
    }

    /**
     * @param $idProduto
     * @return string
     */
    public function add($idProduto = null)
    {
        $data['title'] = 'Adicionar Produto';
        // se tiver um id de usuário, é editar, então tras os dados na tela
        if (!empty($idProduto)) {
            $filter = [
                'idProduto' => $idProduto,
                'status' => 'all'
            ];
            $data['produto'] = $this->produtoModel->getProdutos($filter);
            $data['title'] = 'Editar Produto';
        }
        return view("pages/produtos/add", $data);
    }

    public function createProduto($idProduto = null)
    {
        if ($this->request->isAJAX()) {
            // Removo todos os campos que vem vazio
            array_filter($this->request->getVar());

            // Validação
            if (!$this->validate('produtoRules')) {
                // The validation failed.
                $return = ['msg' => 'error', 'error' => $this->validator->getErrors()];
                return json_encode($return);
            }

            // Recebo os dados
            $data = $this->validator->getValidated();

            //Editar
            if (!empty($idProduto)) {
                $data['idProduto'] = $idProduto;
            }
            $data['updated_at'] = date("Y-m-d H:i:s");

            // construo o vetor para salvar os logs
            $logParams = [
                "guid" => getGUID(),
                "data" => date("Y-m-d H:i:s"),
                "controller" => $this->router->controllerName(),
                "metodo" => $this->router->methodName(),
                "dados" => json_encode($data),
                "tabela" => 'produtos',
                "idUsuario" => infoUsuarioLogado()->idUser,
                "operacao" => empty($idProduto) ? 'i' : 'u'
            ];
            try {
                $this->produtoModel->createProduto($data);
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

    public function deleteProduto($idProduto = null)
    {
        if ($this->request->isAJAX()) {
            // construo o vetor para salvar os logs
            $logParams = [
                "guid" => getGUID(),
                "data" => date("Y-m-d H:i:s"),
                "controller" => $this->router->controllerName(),
                "metodo" => $this->router->methodName(),
                "dados" => $this->getDeletedProduto($idProduto),
                "tabela" => 'produtos',
                "idUsuario" => infoUsuarioLogado()->idUser,
                "operacao" => 'd'
            ];
            try {
                $this->produtoModel->deleteProduto($idProduto);
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

    public function getDeletedProduto($idProduto) {
        $ret = $this->produtoModel
                    ->getProdutoCompleto($idProduto);
        return json_encode($ret);
    }
}


