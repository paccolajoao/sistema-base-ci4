<?php

namespace App\Controllers;

use App\Models\DesenvolvimentoModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Desenvolvimento extends BaseController
{
    private DesenvolvimentoModel $desenvolvimentoModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        // Models
        $this->desenvolvimentoModel = model('DesenvolvimentoModel');
    }

    public function index()
    {
        $data['title'] = ucfirst("desenvolvimento");
        return view("pages/desenvolvimento/index", $data);
    }

    /**
     * [AJAX] Função retorna os funcionários cadastrados
     */
    public function getFuncionarios()
    {
        // TODO FAZER TUDO ISSO NA MODEL, LUGAR DE SELECT É NA MODEL
        if ($this->request->isAJAX()) {
            $this->desenvolvimentoModel
                 ->select('*, null as acao');

            $dataInicial = $this->request->getVar('dataInicial');
            $dataFinal = $this->request->getVar('dataFinal');
            $status = $this->request->getVar('status');

            if (!empty($dataInicial)) {
                $this->desenvolvimentoModel->where('data_admissao >', $dataInicial);
            }

            if (!empty($dataFinal)) {
                $this->desenvolvimentoModel->where('data_admissao <', $dataFinal);
            }

            if (in_array($status, ['0', '1'])) {
                $this->desenvolvimentoModel->where('active', $status);
            }

            $rows = $this->desenvolvimentoModel->findAll();
            $data['data'] = [];
            foreach ($rows as $row) {
                $data['data'][] = [
                    (int)$row->id,
                    $row->nome,
                    $row->cargo,
                    $row->salario,
                    $row->data_admissao,
                    $row->departamento,
                    $row->email,
                    $row->telefone,
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