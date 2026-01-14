<?php
/**
 * Configurações Gerais do Site
 */

if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__));
}

// Domínio
define('DOMAIN', 'conselhosesotericos.com.br');
define('BASE_URL', 'https://' . DOMAIN);
define('SITE_NAME', 'Conselhos Esotéricos');
define('SITE_EMAIL', 'contato@conselhosesotericos.com.br');
define('SITE_PHONE', '+55 11 95165-3210');

// Banco de Dados Hostinger
define('DB_HOST', 'localhost');
define('DB_NAME', 'u812652203_esotico');
define('DB_USER', 'u812652203_esotico20');
define('DB_PASS', 'Conselhos950094');

// Timezone
date_default_timezone_set('America/Sao_Paulo');

// Configurações de Sessão
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1); // HTTPS only

// Configurações de Erro (produção)
if (getenv('ENVIRONMENT') === 'production') {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', ROOT_PATH . '/logs/error.log');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}
