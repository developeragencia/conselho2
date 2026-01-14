<?php
$pageTitle = 'Créditos - Conselhos Esotéricos';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="py-16 min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-center text-blue-800 mb-8">Comprar Créditos</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="border-2 border-gray-200 rounded-lg p-6 text-center hover:border-blue-500 transition-colors">
                    <h3 class="text-2xl font-bold text-blue-800 mb-2">10 Créditos</h3>
                    <p class="text-3xl font-bold text-green-600 mb-4">R$ 50,00</p>
                    <p class="text-gray-600 mb-4">R$ 5,00 por crédito</p>
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                        Comprar
                    </button>
                </div>
                
                <div class="border-2 border-blue-500 rounded-lg p-6 text-center bg-blue-50">
                    <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold mb-2 inline-block">Mais Popular</span>
                    <h3 class="text-2xl font-bold text-blue-800 mb-2">25 Créditos</h3>
                    <p class="text-3xl font-bold text-green-600 mb-4">R$ 100,00</p>
                    <p class="text-gray-600 mb-4">R$ 4,00 por crédito</p>
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                        Comprar
                    </button>
                </div>
                
                <div class="border-2 border-gray-200 rounded-lg p-6 text-center hover:border-blue-500 transition-colors">
                    <h3 class="text-2xl font-bold text-blue-800 mb-2">50 Créditos</h3>
                    <p class="text-3xl font-bold text-green-600 mb-4">R$ 180,00</p>
                    <p class="text-gray-600 mb-4">R$ 3,60 por crédito</p>
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                        Comprar
                    </button>
                </div>
            </div>
            
            <div class="bg-purple-50 rounded-lg p-6">
                <h2 class="text-xl font-bold text-purple-800 mb-4">Como funciona?</h2>
                <ul class="space-y-2 text-gray-700">
                    <li class="flex items-start">
                        <span class="text-purple-600 mr-2">✓</span>
                        <span>Compre créditos e use quando quiser</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-purple-600 mr-2">✓</span>
                        <span>Créditos não expiram</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-purple-600 mr-2">✓</span>
                        <span>Use para consultas de qualquer especialidade</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-purple-600 mr-2">✓</span>
                        <span>Pagamento seguro e rápido</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
