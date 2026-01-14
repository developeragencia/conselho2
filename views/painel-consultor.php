<?php
$pageTitle = 'Painel do Consultor - Conselhos EsotÃ©ricos';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="page-hero">
  <div class="container">
    <h1 class="section-title">Painel do Consultor</h1>
    <p class="section-subtitle">Gerencie agenda, clientes e atendimentos.</p>
  </div>
</section>

<section class="section">
  <div class="container dashboard-grid">
    <div class="panel">
      <div class="card-title">Agenda</div>
      <div class="card-meta">Organize horÃ¡rios e disponibilidade.</div>
    </div>
    <div class="panel">
      <div class="card-title">Clientes</div>
      <div class="card-meta">Acompanhe atendimentos e avaliaÃ§Ãµes.</div>
    </div>
    <div class="panel">
      <div class="card-title">Faturamento</div>
      <div class="card-meta">Resumo financeiro e ganhos.</div>
    </div>
  </div>
</section>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
