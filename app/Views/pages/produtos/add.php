<?= $this->extend('app/app') ?>

<?= $this->section('content') ?>
<!--start main content-->
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Produtos</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active"
                        aria-current="page"><?= !isset($produto) ? 'Novo' : 'Editar' ?></li>
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
                            <a class="nav-link" data-bs-toggle="tab" href="#fornecedores" role="tab"
                               aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Fornecedores</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#estoque" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Estoque</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <form id="produtoData" method="post" enctype="multipart/form-data">
                        <div class="tab-content py-3">
                            <div class="tab-pane fade show active" id="dadosgerais" role="tabpanel">
                                <div class="row g-3">
                                    <input type="hidden" id="id_produto" name="id_produto"
                                           value="<?= $produto->idProduto ?? '' ?>">
                                    <div class="col-md-3">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome"
                                               value="<?= $produto->nome ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="codigo" class="form-label">Código</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo"
                                               placeholder="Código"
                                               value="<?= $produto->codigo ?? '' ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="ativo" class="form-label">Status</label>
                                        <select id="ativo" name="ativo" class="form-select">
                                            <option value="1">Ativo</option>
                                            <option value="0" <?= (isset($produto->ativo) && ($produto->ativo == 0)) ? 'selected' : '' ?>>
                                                Inativo
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="controla_estoque" class="form-label">Controla Estoque</label>
                                        <select id="controla_estoque" name="controla_estoque" class="form-select">
                                            <option value="1">Sim</option>
                                            <option value="0" <?= (isset($produto->controla_estoque) && ($produto->controla_estoque == 0)) ? 'selected' : '' ?>>
                                                Não
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="observacoes" class="form-label">Observações</label>
                                        <textarea class="form-control" id="observacoes" name="observacoes" rows="4"><?= $produto->observacoes ?? '' ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="fornecedores" role="tabpanel">
                                <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee
                                    squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes
                                    anderson artisan four loko farm-to-table craft beer twee. Qui photo booth
                                    letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl
                                    cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.
                                    Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan
                                    fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY
                                    ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr
                                    butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                            </div>
                            <div class="tab-pane fade" id="estoque" role="tabpanel">
                                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's
                                    organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify
                                    pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy
                                    hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred
                                    pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel
                                    fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of
                                    them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray
                                    yr.</p>
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
<script src="<?= base_url('assets/js/pages/produto/produto.js') ?>"></script>
<?= $this->endSection() ?>
