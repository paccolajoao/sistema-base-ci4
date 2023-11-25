<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnidademedidaModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Unidademedida extends BaseController
{
    private UnidademedidaModel $unidademedidaModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->unidademedidaModel = new UnidademedidaModel();

    }

    public function index()
    {
        $data['title'] = ucfirst("unidades de medida");
        return view("pages/unidadesmedida/index", $data);
    }

    /**
     * [AJAX] Função retorna as unidades de medida filtradas
     */
    public function getUnidadesMedida()
    {
        if ($this->request->isAJAX()) {
            $nomeFiltrar = $this->request->getVar('nomeFiltrar');
            $relacionalFiltrar = $this->request->getVar('relacionalFiltrar');
            $statusFiltrar = $this->request->getVar('statusFiltrar');

            $filter = [
                'nome' => $nomeFiltrar,
                'isRelacional' => $relacionalFiltrar,
                'ativo' => $statusFiltrar
            ];

            $ret = $this->unidademedidaModel
                ->getUnidadesMedida($filter);

            $data['data'] = [];
            foreach ($ret as $row) {
                $data['data'][] = [
                    (int)$row->idUnidadeMedida,
                    $row->nome,
                    ($row->isRelacional)
                        ? '<span class="badge bg-success">SIM</span>'
                        : '<span class="badge bg-danger">NÃO</span>',
                    ($row->ativo)
                        ? '<span class="badge bg-success">ATIVO</span>'
                        : '<span class="badge bg-danger">INATIVO</span>',
                    '
                        <button type="button" class="btn btn-sm btn-primary editar-registro" data-id="' . (int)$row->idUnidadeMedida . '"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="button" class="btn btn-sm btn-danger excluir-registro" data-id="' . (int)$row->idUnidadeMedida . '"><i class="fa-solid fa-trash-can"></i></button>
                    '
                ];
            }
            return json_encode($data);
        }
        return view("pages/errors/erro404");
    }

    public function add($idUnidadeMedida = null)
    {
        $data['title'] = ucfirst("adicionar unidade de medida");
        // se tiver um id de unidade de medida, é editar, então tras os dados na tela
        if (!empty($idUnidadeMedida)) {
            $filter = [
                'idUnidadeMedida' => $idUnidadeMedida,
                'isRelacional' => 'all',
                'ativo' => 'all'
            ];
            $data['unidademedida'] = $this->unidademedidaModel->getUnidadesMedida($filter);
        }
        return view("pages/unidadesmedida/add", $data);
    }

    public function createUnidadesMedida($idUnidadeMedida = null)
    {
        if ($this->request->isAJAX()) {
            // Removo todos os campos que vem vazio
            array_filter($this->request->getVar());

            // Validação
            if (!$this->validate('unidadeMedidaRules')) {
                // The validation failed.
                $return = ['msg' => 'error', 'error' => $this->validator->getErrors()];
                return json_encode($return);
            }

            // Recebo os dados
            $data = $this->validator->getValidated();

            //Editar
            if (!empty($idUnidadeMedida)) {
                $data['idUnidadeMedida'] = $idUnidadeMedida;
            }
            $data['updated_at'] = date("Y-m-d H:i:s");
            $data['quantidade'] = formataDecimal($data['quantidade']);
            $data['idUnidadeMedidaBase'] = $data['UMBase'];
            unset($data['UMBase']);

            // construo o vetor para salvar os logs
            $logParams = [
                "guid" => getGUID(),
                "data" => date("Y-m-d H:i:s"),
                "controller" => $this->router->controllerName(),
                "metodo" => $this->router->methodName(),
                "dados" => json_encode($data),
                "tabela" => 'unidadesmedida',
                "idUsuario" => infoUsuarioLogado()->idUser,
                "operacao" => empty($idUnidadeMedida) ? 'i' : 'u'
            ];

            if ($this->unidademedidaModel->createUnidadesMedida($data)) {
                $logParams['isError'] = false;
                $return = ['msg' => 'success'];
            } else {
                $logParams['isError'] = true;
                $logParams['erroTexto'] = 'Erro ao salvar unidade de medida.';
                $return = ['msg' => 'error', 'error' => 'Erro ao salvar unidade de medida.'];
            }
            $this->logs->save($logParams);
            return json_encode($return);
        } else {
            return view("pages/errors/erro404");
        }
    }

    public function deleteUnidadeMedida($idUnidadeMedida = null)
    {
        if ($this->request->isAJAX()) {
            // construo o vetor para salvar os logs
            $logParams = [
                "guid" => getGUID(),
                "data" => date("Y-m-d H:i:s"),
                "controller" => $this->router->controllerName(),
                "metodo" => $this->router->methodName(),
                "dados" => $this->getDeletedUM($idUnidadeMedida),
                "tabela" => 'unidadesmedida',
                "idUsuario" => infoUsuarioLogado()->idUser,
                "operacao" => 'd'
            ];
            try {
                $this->unidademedidaModel->deleteUnidadeMedida($idUnidadeMedida);
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

    public function getDeletedUM($idUM)
    {
        $ret = $this->unidademedidaModel
            ->getUMCompleto($idUM);
        return json_encode($ret);
    }
}
