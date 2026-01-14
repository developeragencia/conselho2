<?php
/**
 * CONSELHOS ESOTÉRICOS - Portal PHP
 * Sistema completo convertido de React para PHP
 */

// Configurações
define('ROOT_PATH', __DIR__);

// Autoload
require_once ROOT_PATH . '/config/config.php';
require_once ROOT_PATH . '/config/autoload.php';
require_once ROOT_PATH . '/config/database.php';

// Inicializar sessão
session_start();

// Roteamento
$router = new Router();
$router->dispatch();
