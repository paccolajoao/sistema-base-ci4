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
          <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Listar</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFiltro">
        <i class="fa-solid fa-magnifying-glass"></i>
        Filtrar
      </button>
      <a type="button" class="btn btn-success" href="<?= base_url('produtos/add') ?>">
          <i class="fa-solid fa-plus"></i>
          Novo
      </a>
      <!-- Modal -->
      <div class="modal fade" id="modalFiltro" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Filtrar Produtos</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="col-md-12">
                <label for="nomeFiltrar" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nomeFiltrar">
              </div>
              <div class="col-md-12">
                <label for="codigoFiltrar" class="form-label">Código</label>
                <input type="text" class="form-control" id="codigoFiltrar">
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
              <button type="button" class="btn btn-danger" id="btnFecharFiltrar" data-bs-dismiss="modal">Fechar</button>
              <button type="button" class="btn btn-success" id="btnFiltrar">Buscar</button>
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
                    <table id="dt_default" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Controla Estoque</th>
                            <th>Status</th>
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
<script src="<?= base_url('assets/js/pages/produto/produto.js') ?>"></script>
<?= $this->endSection() ?>