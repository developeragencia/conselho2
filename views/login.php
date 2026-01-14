<?php
$pageTitle = 'Login - Conselhos EsotÃ©ricos';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="page-hero">
  <div class="container">
    <h1 class="section-title">Acesse sua conta</h1>
    <p class="section-subtitle">Entre para acompanhar suas consultas e crÃ©ditos.</p>
  </div>
</section>

<section class="section">
  <div class="container" style="max-width:520px;">
    <div class="panel">
      <form id="loginForm" class="grid" style="gap:16px;">
        <div>
          <label class="card-meta">Email</label>
          <input class="input" type="email" name="email" required>
        </div>
        <div>
          <label class="card-meta">Senha</label>
          <input class="input" type="password" name="password" required>
        </div>
        <button class="btn btn-primary" type="submit">Entrar</button>
      </form>
      <div class="card-meta" style="margin-top:16px;">NÃ£o tem conta? <a href="/registro">Criar agora</a></div>
    </div>
  </div>
</section>

<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const data = Object.fromEntries(new FormData(e.target));
  try {
    const response = await fetch('/api/auth/login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    });
    const result = await response.json();
    if (result.success) {
      window.location.href = '/dashboard';
    } else {
      alert(result.error || 'Erro ao fazer login');
    }
  } catch (error) {
    alert('Erro ao fazer login');
  }
});
</script>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
