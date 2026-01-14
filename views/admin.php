<?php
$pageTitle = 'Painel Admin - Conselhos EsotÃ©ricos';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="page-hero">
  <div class="container">
    <h1 class="section-title">Painel Administrativo</h1>
    <p class="section-subtitle">GestÃ£o completa do portal.</p>
  </div>
</section>

<section class="section">
  <div class="container dashboard-grid">
    <div class="panel">
      <div class="card-title">UsuÃ¡rios</div>
      <div class="card-meta">Gerencie clientes e consultores.</div>
    </div>
    <div class="panel">
      <div class="card-title">Consultores</div>
      <div class="card-meta">Aprovar e moderar perfis.</div>
    </div>
    <div class="panel">
      <div class="card-title">RelatÃ³rios</div>
      <div class="card-meta">MÃ©tricas e desempenho do portal.</div>
    </div>
  </div>
</section>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
