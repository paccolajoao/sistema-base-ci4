<?= $this->extend('app/app') ?>

<?= $this->section('content') ?>
    <!--start main content-->
    <main class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Desenvolvimento</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Listar</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFiltrarDesenvolvimento">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Filtrar
                </button>
                <a type="button" class="btn btn-success" href="<?= base_url('desenvolvimento/add') ?>">
                    <i class="fa-solid fa-plus"></i>
                    Novo
                </a>
                <!-- Modal -->
                <div class="modal fade" id="modalFiltrarDesenvolvimento" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Filtrar Desenvolvimento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="dataInicialFiltrar" class="form-label">Data Inicial</label>
                                        <input type="date" class="form-control" id="dataInicialFiltrar" value="<?= date("2022-01-01") ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dataFinalFiltrar" class="form-label">Data Final</label>
                                        <input type="date" class="form-control" id="dataFinalFiltrar" value="<?= date("2022-12-31") ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="statusFiltrar" class="form-label">Status</label>
                                    <select id="statusFiltrar" class="form-select">
                                        <option value="all" selected>Todos</option>
                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id="btnFecharFiltrarFuncionarios" data-bs-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-success" id="btnFiltrarFuncionarios">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <hr>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dt_desenvolvimento" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Cargo</th>
                                    <th>Salário</th>
                                    <th>Data Admissão</th>
                                    <th>Departamento</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </main>
    <!--end main content-->
<?= $this->endSection() ?>

<?= $this->section('customjs') ?>
    <script src="<?= base_url('assets/js/pages/desenvolvimento/desenvolvimento.js') ?>"></script>
<?= $this->endSection() ?>