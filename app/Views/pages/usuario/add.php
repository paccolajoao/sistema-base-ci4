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
                    <li class="breadcrumb-item active" aria-current="page"><?= !isset($usuario) ? 'Novo' : 'Editar' ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Adicionar Usuário</h5>
                    <form class="row g-3" id="usuarioData" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="id_usuario" name="id_usuario" value="<?= $usuario->idUser ?? ''  ?>">
                        <div class="col-md-4">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nome" value="<?= $usuario->name ?? ''  ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $usuario->email ?? '' ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select">
                                <option value="1">Ativo</option>
                                <option value="0" <?= (isset($usuario->active) && ($usuario->active == 0)) ? 'selected' : '' ?>>Inativo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="usuario" class="form-label">Usuário</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Usuário" value="<?= $usuario->username ?? '' ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                        </div>
                        <div class="col-md-3">
                            <label for="confirmacao_senha" class="form-label">Confirmação Senha</label>
                            <input type="password" class="form-control" id="pass_conference" name="pass_conference" placeholder="Confirmação de Senha">
                        </div>
                        <div class="col-md-3">
                            <label for="foto_perfil" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="foto_perfil" name="foto_perfil" accept="image/png,image/jpg,image/jpeg">
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="button" class="btn btn-primary px-4" onclick="history.back()">Voltar</button>
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
<script src="<?= base_url('assets/js/pages/usuario.js') ?>"></script>
<?= $this->endSection() ?>
