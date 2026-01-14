<?php
$pageTitle = 'Login - Conselhos Esotéricos';
include ROOT_PATH . '/views/layout/header.php';
?>

<section class="py-16 min-h-screen bg-gray-50">
    <div class="max-w-md mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-center text-blue-800 mb-6">Entrar</h1>
            <form id="loginForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Senha</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-semibold transition-colors">
                    Entrar
                </button>
            </form>
            <p class="mt-4 text-center text-sm text-gray-600">
                Não tem conta? <a href="/registro" class="text-blue-600 hover:underline">Cadastre-se</a>
            </p>
        </div>
    </div>
</section>

<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);
    
    try {
        const response = await fetch('/api/auth/login', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        if (result.success) {
            window.location.href = '/dashboard';
        } else {
            alert(result.error || 'Erro ao fazer login');
        }
    } catch (error) {
        alert('Erro ao fazer login');
    }
});
</script>

<?php include ROOT_PATH . '/views/layout/footer.php'; ?>
