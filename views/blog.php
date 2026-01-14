<?php
$pageTitle = 'Blog - Conselhos Esotéricos';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="py-16 min-h-screen bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-4xl font-bold text-center text-blue-800 mb-12">Blog</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $posts = [
                ['title' => 'Como escolher o consultor ideal', 'excerpt' => 'Dicas para encontrar o profissional certo para sua consulta', 'date' => '2025-01-10'],
                ['title' => 'Os segredos do Tarot', 'excerpt' => 'Entenda como funciona a leitura de tarot', 'date' => '2025-01-08'],
                ['title' => 'Astrologia e seu dia a dia', 'excerpt' => 'Como usar a astrologia para melhorar sua vida', 'date' => '2025-01-05'],
            ];
            
            foreach ($posts as $post):
            ?>
                <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-purple-400 to-blue-500"></div>
                    <div class="p-6">
                        <time class="text-sm text-gray-500"><?= date('d/m/Y', strtotime($post['date'])) ?></time>
                        <h2 class="text-xl font-bold text-blue-800 mt-2 mb-2"><?= htmlspecialchars($post['title']) ?></h2>
                        <p class="text-gray-600 mb-4"><?= htmlspecialchars($post['excerpt']) ?></p>
                        <a href="/blog/<?= strtolower(str_replace(' ', '-', $post['title'])) ?>" class="text-blue-600 hover:underline font-semibold">
                            Ler mais →
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
