<?php
$pageTitle = 'Dashboard - Conselhos Esotéricos';
include ROOT_PATH . '/views/layout/header.php';

$db = Database::getInstance()->getConnection();
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<section class="py-16 min-h-screen bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-blue-800 mb-8">Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Créditos Disponíveis</h3>
                <p class="text-3xl font-bold text-green-600">R$ <?= number_format((float)$user['credits'], 2, ',', '.') ?></p>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Perfil</h3>
                <p class="text-xl font-bold text-blue-800"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></p>
                <p class="text-gray-600"><?= htmlspecialchars($user['email']) ?></p>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Tipo de Conta</h3>
                <p class="text-xl font-bold text-purple-600 uppercase"><?= htmlspecialchars($user['role']) ?></p>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-blue-800 mb-4">Ações Rápidas</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="/consultores" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold text-center transition-colors">
                    Ver Consultores
                </a>
                <a href="/creditos" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold text-center transition-colors">
                    Comprar Créditos
                </a>
            </div>
        </div>
    </div>
</section>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
