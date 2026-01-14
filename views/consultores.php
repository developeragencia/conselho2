<?php
$pageTitle = 'Consultores - Conselhos Esotéricos';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-blue-800 mb-4">Nossos Consultores</h1>
            <p class="text-lg text-gray-600">Encontre o consultor ideal para sua jornada espiritual</p>
        </div>

        <!-- Filtros -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                    <input type="text" id="searchInput" placeholder="Nome do consultor..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Especialidade</label>
                    <select id="specialtyFilter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="all">Todas</option>
                        <?php foreach ($specialties as $spec): ?>
                            <option value="<?= htmlspecialchars($spec) ?>"><?= htmlspecialchars($spec) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="statusFilter" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="all">Todos</option>
                        <option value="online">Disponível</option>
                        <option value="busy">Ocupado</option>
                        <option value="offline">Offline</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Grid de Consultores -->
        <div id="consultantsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($consultants as $c): ?>
                <div class="consultant-card bg-white rounded-lg shadow-lg overflow-hidden" 
                     data-name="<?= strtolower(htmlspecialchars($c['name'])) ?>"
                     data-specialty="<?= strtolower(htmlspecialchars($c['specialty'] ?: '')) ?>"
                     data-status="<?= htmlspecialchars($c['status']) ?>">
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
                        <p class="text-gray-600 mb-2"><?= htmlspecialchars($c['title'] ?: $c['specialty'] ?: 'Especialista') ?></p>
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
                        <p class="text-gray-600 text-sm mb-4"><?= htmlspecialchars($c['description'] ?: '') ?></p>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600 mb-2">
                                R$ <?= number_format((float)$c['price_per_minute'], 2, ',', '.') ?>/min
                            </div>
                            <a href="/consultores/<?= htmlspecialchars($c['slug']) ?>">
                                <button class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-medium transition-colors">
                                    Consultar Agora
                                </button>
                            </a>
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
            
            if (matchSearch && matchSpecialty && matchStatus) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    searchInput.addEventListener('input', filterConsultants);
    specialtyFilter.addEventListener('change', filterConsultants);
    statusFilter.addEventListener('change', filterConsultants);
});
</script>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
