<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Conselhos EsotÃ©ricos' ?></title>
    <meta name="description" content="Conecte-se com consultores especializados em Tarot, Astrologia, Numerologia e Espiritualidade">
    <link rel="icon" type="image/png" href="/CONSELHOS_20250521_110746_0000.png">
    <link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
    <div class="topbar">
        <div class="container topbar-inner">
            <div class="topbar-links">
                <span>+55 11 95165-3210</span>
                <span>24h por dia</span>
                <span>contato@conselhosesotericos.com.br</span>
            </div>
            <div class="topbar-links">
                <a href="https://facebook.com" target="_blank">Facebook</a>
                <a href="https://instagram.com" target="_blank">Instagram</a>
                <a href="https://twitter.com" target="_blank">Twitter</a>
            </div>
        </div>
    </div>

    <div class="navbar">
        <div class="container navbar-inner">
            <a href="/" class="brand">
                <div class="brand-logo">CE</div>
                <div>
                    <div>Conselhos EsotÃ©ricos</div>
                    <small class="card-meta">Portal Espiritual Premium</small>
                </div>
            </a>
            <div class="nav-links">
                <a href="/">Home</a>
                <a href="/consultores">Consultores</a>
                <a href="/blog">Blog</a>
                <a href="/creditos">CrÃ©ditos</a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/dashboard">Painel</a>
                <?php endif; ?>
            </div>
            <div class="nav-actions">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (($_SESSION['user_role'] ?? '') === 'admin'): ?>
                        <a class="btn btn-outline" href="/admin">Admin</a>
                    <?php elseif (($_SESSION['user_role'] ?? '') === 'consultor'): ?>
                        <a class="btn btn-outline" href="/painel-consultor">Consultor</a>
                    <?php else: ?>
                        <a class="btn btn-outline" href="/painel-cliente">Cliente</a>
                    <?php endif; ?>
                    <button class="btn btn-primary" id="logoutBtn">Sair</button>
                <?php else: ?>
                    <a class="btn btn-outline" href="/login">Entrar</a>
                    <a class="btn btn-primary" href="/registro">Criar Conta</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php if (isset($_SESSION['user_id'])): ?>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('logoutBtn');
    if (!btn) return;
    btn.addEventListener('click', async () => {
      await fetch('/api/auth/logout', { method: 'POST' });
      window.location.href = '/';
    });
  });
</script>
<?php endif; ?>
