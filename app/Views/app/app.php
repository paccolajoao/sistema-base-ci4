<!doctype html>
<html lang="en" data-bs-theme="shadow-theme">

<?= view('template/head') ?>

<body>
  <?= view('template/header') ?>
  <?= view('template/menu') ?>
  <?= $this->renderSection('content') ?>
  <?= view('template/footer') ?>
  <?= $this->renderSection('customjs') ?>
</body>

</html>