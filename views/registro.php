<?php
$pageTitle = 'Cadastro - Conselhos EsotÃ©ricos';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="page-hero">
  <div class="container">
    <h1 class="section-title">Crie sua conta</h1>
    <p class="section-subtitle">Comece agora e receba crÃ©ditos iniciais.</p>
  </div>
</section>

<section class="section">
  <div class="container" style="max-width:620px;">
    <div class="panel">
      <form id="registerForm" class="grid" style="gap:16px;">
        <div>
          <label class="card-meta">Nome completo</label>
          <input class="input" type="text" name="name" required>
        </div>
        <div>
          <label class="card-meta">Email</label>
          <input class="input" type="email" name="email" required>
        </div>
        <div>
          <label class="card-meta">Senha</label>
          <input class="input" type="password" name="password" required>
        </div>
        <div>
          <label class="card-meta">CPF</label>
          <input class="input" type="text" name="cpf" required>
        </div>
        <div>
          <label class="card-meta">Telefone</label>
          <input class="input" type="tel" name="phone" required>
        </div>
        <div>
          <label class="card-meta">Tipo de conta</label>
          <select class="select" name="role" required>
            <option value="cliente">Cliente</option>
            <option value="consultor">Consultor</option>
          </select>
        </div>
        <button class="btn btn-primary" type="submit">Criar conta</button>
      </form>
      <div class="card-meta" style="margin-top:16px;">JÃ¡ tem conta? <a href="/login">Entrar</a></div>
    </div>
  </div>
</section>

<script>
document.getElementById('registerForm').addEventListener('submit', async function(e) {
  e.preventDefault();
  const data = Object.fromEntries(new FormData(e.target));
  try {
    const response = await fetch('/api/test/register', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    });
    const result = await response.json();
    if (result.success) {
      alert(result.message);
      window.location.href = '/login';
    } else {
      alert(result.error || 'Erro ao criar conta');
    }
  } catch (error) {
    alert('Erro ao criar conta');
  }
});
</script>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
