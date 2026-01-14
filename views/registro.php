<?php
$pageTitle = 'Registro - Conselhos Esotéricos';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="py-16 min-h-screen bg-gray-50">
    <div class="max-w-md mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-center text-blue-800 mb-6">Criar Conta</h1>
            <form id="registerForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nome Completo</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Senha</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">CPF</label>
                    <input type="text" name="cpf" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Telefone</label>
                    <input type="tel" name="phone" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de Conta</label>
                    <select name="role" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="cliente">Cliente</option>
                        <option value="consultor">Consultor</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg font-semibold transition-colors">
                    Criar Conta
                </button>
            </form>
            <p class="mt-4 text-center text-sm text-gray-600">
                Já tem conta? <a href="/login" class="text-blue-600 hover:underline">Entrar</a>
            </p>
        </div>
    </div>
</section>

<script>
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);
    
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
