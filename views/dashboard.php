<?php
$pageTitle = 'Dashboard - Conselhos EsotÃ©ricos';
include ROOT_PATH . '/views/layout/header.php';

$db = Database::getInstance()->getConnection();
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<section class="page-hero">
  <div class="container">
    <h1 class="section-title">OlÃ¡, <?= htmlspecialchars($user['first_name']) ?></h1>
    <p class="section-subtitle">Gerencie suas consultas, crÃ©ditos e preferÃªncias.</p>
  </div>
</section>

<section class="section">
  <div class="container dashboard-grid">
    <div class="panel">
      <div class="card-title">CrÃ©ditos</div>
      <div class="card-meta">Saldo disponÃ­vel</div>
      <div style="font-size:32px; margin-top:8px;">R$ <?= number_format((float)$user['credits'], 2, ',', '.') ?></div>
    </div>
    <div class="panel">
      <div class="card-title">Perfil</div>
      <div class="card-meta"><?= htmlspecialchars($user['email']) ?></div>
      <div style="margin-top:8px; text-transform:uppercase; color:var(--accent);"><?= htmlspecialchars($user['role']) ?></div>
    </div>
    <div class="panel">
      <div class="card-title">AÃ§Ãµes rÃ¡pidas</div>
      <div style="display:flex; gap:10px; margin-top:12px; flex-wrap:wrap;">
        <a class="btn btn-primary" href="/consultores">Consultar</a>
        <a class="btn btn-outline" href="/creditos">Comprar crÃ©ditos</a>
      </div>
    </div>
  </div>
</section>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
