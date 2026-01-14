<?php
$pageTitle = 'Conselhos EsotÃ©ricos - Portal Espiritual Premium';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="hero">
  <div class="container hero-grid">
    <div>
      <div class="badge badge-online">Online 24h</div>
      <h1 class="hero-title">Conselhos EsotÃ©ricos para decisÃµes com clareza</h1>
      <p class="hero-subtitle">Conecte-se com especialistas em Tarot, Astrologia, Runas e Numerologia. Consultas rÃ¡pidas, seguras e confidenciais.</p>
      <div class="nav-actions">
        <a class="btn btn-primary" href="/consultores">Ver Consultores</a>
        <a class="btn btn-outline" href="/creditos">Comprar CrÃ©ditos</a>
      </div>
    </div>
    <div class="hero-cards">
      <div class="hero-card">
        <div class="card-title">Atendimento instantÃ¢neo</div>
        <div class="card-meta">Tempo mÃ©dio de resposta: 2 min</div>
      </div>
      <div class="hero-card">
        <div class="card-title">Consultores verificados</div>
        <div class="card-meta">Perfis com avaliaÃ§Ãµes reais</div>
      </div>
      <div class="hero-card">
        <div class="card-title">Planos flexÃ­veis</div>
        <div class="card-meta">CrÃ©ditos e pacotes acessÃ­veis</div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2 class="section-title">Consultores em destaque</h2>
    <p class="section-subtitle">Escolha o especialista ideal para sua jornada espiritual.</p>

    <div class="grid grid-4">
      <?php foreach (array_slice($consultants, 0, 4) as $c): ?>
        <div class="card">
          <img src="<?= htmlspecialchars($c['image_url'] ?: '/images/placeholder-avatar.png') ?>" alt="<?= htmlspecialchars($c['name']) ?>">
          <div class="card-body">
            <div class="card-title"><?= htmlspecialchars($c['name']) ?></div>
            <div class="card-meta"><?= htmlspecialchars($c['specialty'] ?: $c['title'] ?: 'Especialista') ?></div>
            <div style="margin:12px 0;">
              <?php if ($c['status'] === 'online'): ?>
                <span class="badge badge-online">DisponÃ­vel</span>
              <?php elseif ($c['status'] === 'busy'): ?>
                <span class="badge badge-busy">Ocupado</span>
              <?php else: ?>
                <span class="badge badge-offline">Offline</span>
              <?php endif; ?>
            </div>
            <div class="card-meta">R$ <?= number_format((float)$c['price_per_minute'], 2, ',', '.') ?>/min</div>
            <div style="margin-top:14px;">
              <a class="btn btn-primary" href="/consultores/<?= htmlspecialchars($c['slug']) ?>">Consultar</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2 class="section-title">ServiÃ§os premium</h2>
    <p class="section-subtitle">MÃ©todos poderosos para orientar suas decisÃµes com confianÃ§a.</p>
    <div class="grid grid-3">
      <div class="card"><div class="card-body"><div class="card-title">Tarot Profundo</div><div class="card-meta">Leituras detalhadas e direcionadas.</div></div></div>
      <div class="card"><div class="card-body"><div class="card-title">Astrologia EstratÃ©gica</div><div class="card-meta">Mapas astrais para decisÃµes conscientes.</div></div></div>
      <div class="card"><div class="card-body"><div class="card-title">Runas & OrÃ¡culos</div><div class="card-meta">OrientaÃ§Ã£o energÃ©tica e espiritual.</div></div></div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container panel">
    <h2 class="section-title">Pronto para comeÃ§ar?</h2>
    <p class="section-subtitle">Cadastre-se agora e receba crÃ©ditos iniciais para sua primeira consulta.</p>
    <a class="btn btn-primary" href="/registro">Criar conta grÃ¡tis</a>
  </div>
</section>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
