<?php
$pageTitle = 'Consultores - Conselhos EsotÃ©ricos';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="page-hero">
  <div class="container">
    <h1 class="section-title">Encontre seu consultor ideal</h1>
    <p class="section-subtitle">Filtre por especialidade, status e preÃ§o para escolher o melhor profissional.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="filters">
      <div>
        <label class="card-meta">Buscar</label>
        <input class="input" type="text" id="searchInput" placeholder="Nome do consultor">
      </div>
      <div>
        <label class="card-meta">Especialidade</label>
        <select class="select" id="specialtyFilter">
          <option value="all">Todas</option>
          <?php foreach ($specialties as $spec): ?>
            <option value="<?= htmlspecialchars($spec) ?>"><?= htmlspecialchars($spec) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label class="card-meta">Status</label>
        <select class="select" id="statusFilter">
          <option value="all">Todos</option>
          <option value="online">DisponÃ­vel</option>
          <option value="busy">Ocupado</option>
          <option value="offline">Offline</option>
        </select>
      </div>
    </div>

    <div id="consultantsGrid" class="grid grid-3" style="margin-top:24px;">
      <?php foreach ($consultants as $c): ?>
        <div class="card consultant-card" data-name="<?= strtolower(htmlspecialchars($c['name'])) ?>" data-specialty="<?= strtolower(htmlspecialchars($c['specialty'] ?: '')) ?>" data-status="<?= htmlspecialchars($c['status']) ?>">
          <img src="<?= htmlspecialchars($c['image_url'] ?: '/images/placeholder-avatar.png') ?>" alt="<?= htmlspecialchars($c['name']) ?>">
          <div class="card-body">
            <div class="card-title"><?= htmlspecialchars($c['name']) ?></div>
            <div class="card-meta"><?= htmlspecialchars($c['title'] ?: $c['specialty'] ?: 'Especialista') ?></div>
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
              <a class="btn btn-primary" href="/consultores/<?= htmlspecialchars($c['slug']) ?>">Ver perfil</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('searchInput');
  const specialtyFilter = document.getElementById('specialtyFilter');
  const statusFilter = document.getElementById('statusFilter');
  const cards = document.querySelectorAll('.consultant-card');

  function filterConsultants() {
    const searchTerm = searchInput.value.toLowerCase();
    const specialty = specialtyFilter.value.toLowerCase();
    const status = statusFilter.value.toLowerCase();

    cards.forEach(card => {
      const name = card.dataset.name;
      const cardSpecialty = card.dataset.specialty;
      const cardStatus = card.dataset.status;

      const matchSearch = !searchTerm || name.includes(searchTerm);
      const matchSpecialty = specialty === 'all' || cardSpecialty === specialty;
      const matchStatus = status === 'all' || cardStatus === status;

      card.style.display = (matchSearch && matchSpecialty && matchStatus) ? 'block' : 'none';
    });
  }

  searchInput.addEventListener('input', filterConsultants);
  specialtyFilter.addEventListener('change', filterConsultants);
  statusFilter.addEventListener('change', filterConsultants);
});
</script>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
