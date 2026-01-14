<?php
$pageTitle = ($consultant['name'] ?? 'Consultor') . ' - Conselhos EsotÃ©ricos';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="page-hero">
  <div class="container">
    <h1 class="section-title"><?= htmlspecialchars($consultant['name'] ?? 'Consultor') ?></h1>
    <p class="section-subtitle"><?= htmlspecialchars($consultant['title'] ?: $consultant['specialty'] ?: 'Especialista') ?></p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="card">
      <img src="<?= htmlspecialchars($consultant['image_url'] ?: '/images/placeholder-avatar.png') ?>" alt="<?= htmlspecialchars($consultant['name']) ?>">
      <div class="card-body">
        <div class="card-meta"><?= htmlspecialchars($consultant['description'] ?: 'Consultor experiente pronto para te ajudar.') ?></div>
        <div style="margin:12px 0;">
          <?php if ($consultant['status'] === 'online'): ?>
            <span class="badge badge-online">DisponÃ­vel</span>
          <?php elseif ($consultant['status'] === 'busy'): ?>
            <span class="badge badge-busy">Ocupado</span>
          <?php else: ?>
            <span class="badge badge-offline">Offline</span>
          <?php endif; ?>
        </div>
        <div class="card-title">R$ <?= number_format((float)$consultant['price_per_minute'], 2, ',', '.') ?>/min</div>
        <div style="margin-top:16px; display:flex; gap:12px; flex-wrap:wrap;">
          <a class="btn btn-primary" href="/consultores">Voltar</a>
          <a class="btn btn-outline" href="/creditos">Comprar crÃ©ditos</a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
