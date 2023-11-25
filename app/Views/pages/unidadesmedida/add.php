<?= $this->extend('app/app') ?>

<?= $this->section('content') ?>
<!--start main content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Unidades de Medida</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active"
                        aria-current="page"><?= !isset($unidademedida) ? 'Novo' : 'Editar' ?></li>
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
                    </ul>
                    <form id="unidadesMedidaData" method="post" enctype="multipart/form-data">
                        <div class="tab-content py-3">
                            <div class="tab-pane fade show active" id="dadosgerais" role="tabpanel">
                                <div class="row g-3">
                                    <input type="hidden" id="id_unidade_medida" name="id_unidade_medida"
                                           value="<?= $unidademedida->idUnidadeMedida ?? '' ?>">
                                    <div class="col-md-3">
                                        <label for="nome" class="form-label">Nome<span class="obrigatorio"> *</span></label>
                                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome"
                                               value="<?= $unidademedida->nome ?? '' ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="ativo" class="form-label">Status<span class="obrigatorio"> *</span></label>
                                        <select id="ativo" name="ativo" class="form-select">
                                            <option value="1">Ativo</option>
                                            <option value="0" <?= (isset($unidademedida->ativo) && ($unidademedida->ativo == 0)) ? 'selected' : '' ?>>
                                                Inativo
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="isRelacional" class="form-label">Relacional<span class="obrigatorio"> *</span></label>
                                        <select id="isRelacional" name="isRelacional" class="form-select">
                                            <option value="0">
                                                Não
                                            </option>
                                            <option value="1" <?= (isset($unidademedida->isRelacional) && ($unidademedida->isRelacional == 1)) ? 'selected' : '' ?>>
                                                Sim
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 hidden-by-relacional d-none">
                                        <label for="UMBase" class="form-label">Unidade de Medida Base</label>
                                        <select class="form-select" id="UMBase" name="UMBase" data-umbase="<?= $unidademedida->UMBase ?? '' ?>"></select>
                                    </div>
                                    <div class="col-md-2 hidden-by-relacional d-none">
                                        <label for="quantidade" class="form-label">Quantidade <small>(6 casas decimais)</small></label>
                                        <input type="text" class="form-control quantidade_umbase" id="quantidade" name="quantidade"
                                               value="<?= $unidademedida->quantidade ?? '' ?>">
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
<script src="<?= base_url('assets/js/pages/unidadesmedida/unidadesmedida.js') ?>"></script>
<?= $this->endSection() ?>
