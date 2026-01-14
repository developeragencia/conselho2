<?php
$pageTitle = ($consultant['name'] ?? 'Consultor') . ' - Conselhos Esotéricos';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4">
        <?php if ($consultant): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="relative h-64 bg-gradient-to-r from-purple-600 to-blue-600">
                    <img 
                        src="<?= htmlspecialchars($consultant['image_url'] ?: '/images/placeholder-avatar.png') ?>" 
                        alt="<?= htmlspecialchars($consultant['name']) ?>" 
                        class="w-32 h-32 rounded-full border-4 border-white absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 object-cover"
                    >
                </div>
                <div class="pt-20 pb-8 px-8 text-center">
                    <h1 class="text-3xl font-bold text-blue-800 mb-2"><?= htmlspecialchars($consultant['name']) ?></h1>
                    <p class="text-xl text-gray-600 mb-4"><?= htmlspecialchars($consultant['title'] ?: $consultant['specialty'] ?: 'Especialista') ?></p>
                    
                    <div class="flex items-center justify-center mb-4">
                        <div class="flex text-yellow-400">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <?php endfor; ?>
                        </div>
                        <span class="ml-2 text-lg text-gray-700">
                            <?= number_format((float)$consultant['rating'], 1) ?> (<?= (int)$consultant['review_count'] ?> avaliações)
                        </span>
                    </div>
                    
                    <div class="mb-6">
                        <span class="px-4 py-2 rounded-full text-sm font-medium <?= 
                            $consultant['status'] === 'online' ? 'bg-green-500 text-white' : 
                            ($consultant['status'] === 'busy' ? 'bg-yellow-500 text-black' : 'bg-gray-500 text-white')
                        ?>">
                            <?= $consultant['status'] === 'online' ? 'Disponível Agora' : ($consultant['status'] === 'busy' ? 'Ocupado' : 'Offline') ?>
                        </span>
                    </div>
                    
                    <p class="text-gray-700 mb-8 text-lg"><?= htmlspecialchars($consultant['description'] ?: 'Consultor experiente pronto para te ajudar.') ?></p>
                    
                    <div class="bg-purple-50 rounded-lg p-6 mb-6">
                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-2">Preço por minuto</p>
                            <p class="text-4xl font-bold text-green-600">
                                R$ <?= number_format((float)$consultant['price_per_minute'], 2, ',', '.') ?>/min
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex gap-4 justify-center">
                        <a href="/consultores/<?= htmlspecialchars($consultant['slug']) ?>/chat" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                            Iniciar Consulta
                        </a>
                        <a href="/consultores" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-8 py-3 rounded-lg font-semibold transition-colors">
                            Voltar
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Consultor não encontrado</h2>
                <a href="/consultores" class="text-blue-600 hover:underline">Voltar para lista de consultores</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
