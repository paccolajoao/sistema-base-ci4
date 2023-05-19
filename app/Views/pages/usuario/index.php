<?= $this->extend('app/app') ?>

<?= $this->section('content') ?>
<!--start main content-->
<main class="page-content">
  <!--breadcrumb-->
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Usuários</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Listar Usuários</li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFiltrarUsuario">
        <i class="fa-solid fa-magnifying-glass"></i>
        Filtrar
      </button>
      <!-- Modal -->
      <div class="modal fade" id="modalFiltrarUsuario" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Filtrar Usuários</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="col-md-12">
                <label for="bsValidation1" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="bsValidation1">
                <div class="invalid-feedback">
                  Please select date.
                </div>
              </div>
              <div class="col-md-12">
                <label for="bsValidation2" class="form-label">Nome</label>
                <input type="text" class="form-control" id="bsValidation2">
                <div class="invalid-feedback">
                  Please select date.
                </div>
              </div>
              <div class="col-md-12">
                <label for="bsValidation9" class="form-label">Status</label>
                <select id="bsValidation9" class="form-select">
                  <option value="all" selected>Todos</option>
                  <option value="1">Ativo</option>
                  <option value="0">Inativo</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
              <button type="button" class="btn btn-success" id="btnFiltrarUsuarios">Buscar</button>
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
          <table class="table mb-0 table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!--end row-->
</main>
<!--end main content-->
<?= $this->endSection() ?>

<?= $this->section('customjs') ?>
<script src="<?= base_url('assets/js/pages/usuario.js') ?>"></script>
<?= $this->endSection() ?>