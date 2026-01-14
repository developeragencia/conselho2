<?php
$pageTitle = 'Painel do Cliente - Conselhos EsotÃ©ricos';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="page-hero">
  <div class="container">
    <h1 class="section-title">Painel do Cliente</h1>
    <p class="section-subtitle">Gerencie consultas, crÃ©ditos e preferÃªncias pessoais.</p>
  </div>
</section>

<section class="section">
  <div class="container dashboard-grid">
    <div class="panel">
      <div class="card-title">Minhas consultas</div>
      <div class="card-meta">Acompanhe consultas em andamento e histÃ³rico.</div>
    </div>
    <div class="panel">
      <div class="card-title">CrÃ©ditos</div>
      <div class="card-meta">Saldo e histÃ³rico de compras.</div>
    </div>
    <div class="panel">
      <div class="card-title">Perfil</div>
      <div class="card-meta">Atualize seus dados e preferÃªncias.</div>
    </div>
  </div>
</section>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
