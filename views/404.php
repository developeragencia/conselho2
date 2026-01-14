<?php
$pageTitle = 'Página não encontrada';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="py-32 text-center">
    <div class="max-w-2xl mx-auto px-4">
        <h1 class="text-6xl font-bold text-gray-800 mb-4">404</h1>
        <p class="text-xl text-gray-600 mb-8">Página não encontrada</p>
        <a href="/" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
            Voltar para Home
        </a>
    </div>
</section>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
