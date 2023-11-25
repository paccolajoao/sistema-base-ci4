<?= $this->extend('app/app') ?>

<?= $this->section('content') ?>
<!--start main content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Fornecedores</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active"
                        aria-current="page"><?= !isset($fornecedor) ? 'Novo' : 'Editar' ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <ul class="nav nav-tabs nav-primary" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#dadosgerais" role="tab"
                               aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bi bi-home font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Dados Gerais</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#enderecos" role="tab"
                               aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Endereço</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#contato" role="tab"
                               aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Contato</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#produtos" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Produtos</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#servicos" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Serviços</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <form id="fornecedorData" method="post" enctype="multipart/form-data">
                        <div class="tab-content py-3">
                            <div class="tab-pane fade show active" id="dadosgerais" role="tabpanel">
                                <div class="row g-3">
                                    <input type="hidden" id="id_fornecedor" name="id_fornecedor"
                                           value="<?= $fornecedor->idFornecedor ?? '' ?>">
                                    <div class="col-md-3">
                                        <label for="ativo" class="form-label">Status</label>
                                        <select id="ativo" name="ativo" class="form-select">
                                            <option value="1">Ativo</option>
                                            <option value="0" <?= (isset($fornecedor->ativo) && ($fornecedor->ativo == 0)) ? 'selected' : '' ?>>
                                                Inativo
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="tipo" class="form-label">Tipo</label>
                                        <select id="tipo" name="tipo" class="form-select">
                                            <option value="1">Pessoa Jurídica</option>
                                            <option value="2" <?= (isset($fornecedor->tipo) && ($fornecedor->tipo == 2)) ? 'selected' : '' ?>>
                                                Pessoa Física
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="porte" class="form-label">Porte</label>
                                        <select id="porte" name="porte" class="form-select">
                                            <option value="1">MEI - Microempreendedor Individual</option>
                                            <option value="2">ME - Microempresa</option>
                                            <option value="3">EPP - Empresas de pequeno porte</option>
                                            <option value="4">EMG - Empresas de médio ou grande porte</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cpf_cnpj" class="form-label label-cpf-cnpj">CNPJ<span class="obrigatorio"> *</span></label>
                                        <input type="text" class="form-control cnpj" id="cpf_cnpj" name="cpf_cnpj"
                                               value="<?= $fornecedor->cpf_cnpj ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="razao_social" class="form-label">Razão Social<span class="obrigatorio"> *</span></label>
                                        <input type="text" class="form-control" id="razao_social" name="razao_social"
                                               value="<?= $fornecedor->razao_social ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="nome_fantasia" class="form-label">Nome Fantasia</label>
                                        <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia"
                                               value="<?= $fornecedor->nome_fantasia ?? '' ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="codigo" class="form-label">Código</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo"
                                               value="<?= $fornecedor->codigo ?? '' ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inscricao_municipal" class="form-label">Inscrição Municipal</label>
                                        <input type="text" class="form-control" id="inscricao_municipal" name="inscricao_municipal"
                                               value="<?= $fornecedor->inscricao_municipal ?? '' ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inscricao_estadual" class="form-label">Inscrição Estadual</label>
                                        <input type="text" class="form-control" id="inscricao_estadual" name="inscricao_estadual"
                                               value="<?= $fornecedor->inscricao_estadual ?? '' ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="observacoes" class="form-label">Observações</label>
                                        <textarea class="form-control" id="observacoes" name="observacoes" rows="4"><?= $fornecedor->observacoes ?? '' ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="enderecos" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label for="cep" class="form-label">CEP</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control cep" id="cep" name="cep" aria-describedby="cep_button">
                                            <button class="btn btn-outline-primary" type="button" id="cep_button"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="endereco" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco"
                                               value="<?= $fornecedor->endereco ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="numero" class="form-label">Número</label>
                                        <input type="text" class="form-control" id="numero" name="numero"
                                               value="<?= $fornecedor->numero ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="bairro" class="form-label">Bairro</label>
                                        <input type="text" class="form-control" id="bairro" name="bairro"
                                               value="<?= $fornecedor->bairro ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" id="complemento" name="complemento"
                                               value="<?= $fornecedor->complemento ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <select class="form-select" id="cidade" name="cidade"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contato" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="text" class="form-control telefone" id="telefone" name="telefone"
                                               value="<?= $fornecedor->telefone ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="telefone2" class="form-label">Telefone 2</label>
                                        <input type="text" class="form-control telefone" id="telefone2" name="telefone2"
                                               value="<?= $fornecedor->telefone2 ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="celular" class="form-label">Celular</label>
                                        <input type="text" class="form-control telefone" id="celular" name="celular"
                                               value="<?= $fornecedor->celular ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="celular2" class="form-label">Celular 2</label>
                                        <input type="text" class="form-control telefone" id="celular2" name="celular2"
                                               value="<?= $fornecedor->celular2 ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="<?= $fornecedor->email ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="responsavel" class="form-label">Responsável</label>
                                        <input type="text" class="form-control" id="responsavel" name="responsavel"
                                               value="<?= $fornecedor->responsavel ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="responsavel_celular" class="form-label">Celular do Responsável</label>
                                        <input type="text" class="form-control" id="responsavel_celular" name="responsavel_celular"
                                               value="<?= $fornecedor->responsavel_celular ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="responsavel_email" class="form-label">Email do Responsável</label>
                                        <input type="email" class="form-control" id="responsavel_email" name="responsavel_email"
                                               value="<?= $fornecedor->responsavel_email ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" class="btn btn-primary px-4" onclick="history.back()">Voltar
                                </button>
                                <button type="submit" class="btn btn-success px-4">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--end row-->

</main>
<!--end main content-->
<?= $this->endSection() ?>

<?= $this->section('customjs') ?>
<script src="<?= base_url('assets/js/pages/fornecedor/fornecedor.js') ?>"></script>
<?= $this->endSection() ?>
