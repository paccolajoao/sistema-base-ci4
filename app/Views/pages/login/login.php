<!doctype html>
<html lang="en" data-bs-theme="shadow-theme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!--plugins-->
    <link href="<?= base_url('assets/plugins/notifications/css/lobibox.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/metismenu/css/metisMenu.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/simplebar/css/simplebar.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet">
    <!-- loader-->
    <link href="<?= base_url('assets/css/pace.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/js/pace.min.js') ?>"></script>
    <!--Styles-->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/icons.css') ?>">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/shadow-theme.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet">
    <script src="https://kit.fontawesome.com/602fcda4ef.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
<!--authentication-->
<div class="container-fluid my-5">
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5 col-xxl-4 mx-auto">
            <div class="card border-3">
                <div class="card-body p-5">
                    <img src="assets/images/logo-icon.png" class="mb-4" width="45" alt="">

                    <!-- Alertas das mensagens de erro-->
                    <?php if (!empty(session()->getFlashdata('retorno'))): ?>
                        <div class="alert border-0 bg-danger-subtle alert-dismissible fade show py-2">
                            <div class="d-flex align-items-center">
                                <div class="fs-3 text-danger"><span class="material-symbols-outlined">cancel</span>
                                </div>
                                <div class="ms-3">
                                    <div class="text-danger">
                                        <?php
                                            foreach (session()->getFlashdata('retorno')['error'] as $erro) {
                                                echo $erro . "<br>";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="form-body mt-4">
                        <form class="row g-3" method="post" action="<?= url_to('login/realizarlogin') ?>">
                            <div class="col-12">
                                <label for="input_user" class="form-label">Usuário</label>
                                <input type="text" class="form-control" name="input_user" id="input_user"
                                       placeholder="Digite o usuário">
                            </div>
                            <div class="col-12">
                                <label for="input_password" class="form-label">Senha</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" class="form-control border-end-0" name="input_password"
                                           id="input_password" value="" placeholder="Digite a senha">
                                    <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                class="bi bi-eye-slash-fill"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-end"><a href="auth-basic-forgot-password.html">Forgot Password
                                    ?</a>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-start">
                                    <p class="mb-0">Don't have an account yet? <a href="auth-basic-register.html">Sign
                                            up here</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div><!--end row-->
</div>
<!--authentication-->

<!--plugins-->
<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') ?>"></script>
<script src="<?= base_url('assets/plugins/metismenu/js/metisMenu.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/simplebar/js/simplebar.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/apex/apexcharts.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatable/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/notifications/js/lobibox.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/notifications/js/notifications.min.js') ?>"></script>
<script src="<?= base_url('assets/js/index.js') ?>"></script>
<!--BS Scripts-->
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>
<script src="<?= base_url('assets/js/utils.js') ?>"></script>
<script src="<?= base_url('assets/js/pages/login/login.js') ?>"></script>

</body>
</html>