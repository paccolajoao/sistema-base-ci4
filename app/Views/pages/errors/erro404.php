<!doctype html>
<html lang="en" data-bs-theme="shadow-theme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 NOT FOUND</title>

    <!--plugins-->
    <link href="<?= base_url('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/metismenu/css/metisMenu.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/plugins/simplebar/css/simplebar.css') ?>" rel="stylesheet">
    <!--Styles-->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/icons.css') ?>">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">
</head>

<body class="bg-error">
    <!-- Start wrapper-->
    <div class="pt-5">
        <div class="container pt-5">
            <div class="row pt-5">
                <div class="col-lg-12">
                    <div class="text-center error-pages">
                        <h1 class="error-title text-primary mb-3">404</h1>
                        <h2 class="error-sub-title text-white">404 NOT FOUND</h2>

                        <p class="error-message text-white text-uppercase">DESCULPE, OCORREU UM ERRO E A PÁGINA SOLICITADA NÃO FOI ENCONTRADA!</p>

                        <div class="mt-4 d-flex align-items-center justify-content-center gap-3">
                            <a href="<?= base_url('/') ?>" class="btn btn-primary rounded-5 px-4"><i class="bi bi-house-fill me-2"></i>Home</a>
                            <a class="btn btn-outline-light rounded-5 px-4" onclick="backPageFunc();"><i class="bi bi-arrow-left me-2"></i>Voltar</a>
                        </div>

                        <div class="mt-4">
                            <p class="text-light">Copyright © <?= date("Y") ?> | Todos os direitos reservados.</p>
                        </div>
                        <hr class="border-light border-2">
                    </div>
                </div>
            </div><!--end row-->
        </div>
    </div><!--wrapper-->
</body>
</html>
<script>
    function backPageFunc() {
        history.back();
    }
</script>