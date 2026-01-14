<?php
$pageTitle = 'Conselhos Esotéricos - Portal de Consultas Místicas';
include ROOT_PATH . '/views/layout/header.php';
?>

<!-- Seção Hero -->
<section class="relative h-screen overflow-hidden bg-gradient-to-br from-purple-800 to-blue-800">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative z-10 h-full flex items-center justify-center text-center text-white px-4">
        <div class="max-w-4xl">
            <p class="text-2xl mb-4 opacity-90">A TUA VIDA ESTÁ UM POUCO BAGUNÇADA?</p>
            <h1 class="text-6xl font-bold mb-6">PODEMOS TE AJUDAR A ENCONTRAR O CAMINHO</h1>
            <p class="text-xl mb-8">e desfrutar do equilíbrio, da paz, o amor e a tranquilidade</p>
            <a href="/consultores" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-black px-8 py-3 text-lg font-semibold rounded transition-colors">
                Consultar Agora
            </a>
        </div>
    </div>
</section>

<!-- Seção Consultores -->
<section id="consultores" class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-blue-800 mb-4">Nossos Consultores</h2>
            <p class="text-lg text-gray-600">Profissionais experientes prontos para te ajudar</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php if (empty($consultants)): ?>
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden animate-pulse h-96"></div>
                <?php endfor; ?>
            <?php else: ?>
                <?php foreach (array_slice($consultants, 0, 4) as $c): ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="relative">
                            <img 
                                src="<?= htmlspecialchars($c['image_url'] ?: '/images/placeholder-avatar.png') ?>" 
                                alt="<?= htmlspecialchars($c['name']) ?>" 
                                class="w-full h-64 object-cover"
                            >
                            <div class="absolute top-4 right-4">
                                <span class="px-2 py-1 rounded text-xs font-medium <?= 
                                    $c['status'] === 'online' ? 'bg-green-500 text-white' : 
                                    ($c['status'] === 'busy' ? 'bg-yellow-500 text-black' : 'bg-gray-500 text-white')
                                ?>">
                                    <?= $c['status'] === 'online' ? 'Disponível' : ($c['status'] === 'busy' ? 'Ocupado' : 'Offline') ?>
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-blue-800 mb-2"><?= htmlspecialchars($c['name']) ?></h3>
                            <div class="flex items-center mb-3">
                                <div class="flex text-yellow-400">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    <?php endfor; ?>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">
                                    <?= number_format((float)$c['rating'], 1) ?> (<?= (int)$c['review_count'] ?>)
                                </span>
                            </div>
                            <p class="text-gray-600 mb-4"><?= htmlspecialchars($c['specialty'] ?: $c['title'] ?: 'Especialista') ?></p>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600 mb-2">
                                    R$ <?= number_format((float)$c['price_per_minute'], 2, ',', '.') ?>/min
                                </div>
                                <a href="/consultores/<?= htmlspecialchars($c['slug']) ?>">
                                    <button class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-medium flex items-center justify-center transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                        </svg>
                                        Consultar
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
