<?php
$pageTitle = 'Blog - Conselhos EsotÃ©ricos';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="page-hero">
  <div class="container">
    <h1 class="section-title">Blog & Insights</h1>
    <p class="section-subtitle">ConteÃºdos sobre espiritualidade, tarot e autoconhecimento.</p>
  </div>
</section>

<section class="section">
  <div class="container grid grid-3">
    <?php
      $posts = [
        ['title' => 'Como escolher o consultor ideal', 'excerpt' => 'Dicas prÃ¡ticas para encontrar o profissional certo.', 'date' => '2026-01-10'],
        ['title' => 'Tarot e clareza emocional', 'excerpt' => 'O tarot como ferramenta de autoconhecimento.', 'date' => '2026-01-08'],
        ['title' => 'Astrologia estratÃ©gica', 'excerpt' => 'Tome decisÃµes alinhadas ao seu mapa astral.', 'date' => '2026-01-05'],
      ];
      foreach ($posts as $post):
    ?>
      <div class="card">
        <div style="height:140px; background:linear-gradient(135deg,#7c5cff,#23d4b6);"></div>
        <div class="card-body">
          <div class="card-meta"><?= date('d/m/Y', strtotime($post['date'])) ?></div>
          <div class="card-title"><?= htmlspecialchars($post['title']) ?></div>
          <div class="card-meta"><?= htmlspecialchars($post['excerpt']) ?></div>
          <div style="margin-top:14px;"><a class="btn btn-outline" href="#">Ler mais</a></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
