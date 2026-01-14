<?php
/**
 * Autoloader para classes PHP
 */
spl_autoload_register(function ($class) {
    $paths = [
        ROOT_PATH . '/classes/' . $class . '.php',
        ROOT_PATH . '/models/' . $class . '.php',
        ROOT_PATH . '/controllers/' . $class . '.php',
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});
