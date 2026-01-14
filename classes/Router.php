<?php
/**
 * Sistema de Roteamento
 */
class Router {
    private $routes = [];
    
    public function __construct() {
        $this->registerRoutes();
    }
    
    private function registerRoutes() {
        // Rotas da API
        $this->routes['GET']['/api/consultants'] = 'ApiController@getConsultants';
        $this->routes['GET']['/api/consultants/featured'] = 'ApiController@getConsultantsFeatured';
        $this->routes['GET']['/api/consultants/:slug'] = 'ApiController@getConsultantBySlug';
        $this->routes['POST']['/api/auth/login'] = 'ApiController@login';
        $this->routes['POST']['/api/test/register'] = 'ApiController@register';
        
        // Rotas de pÃ¡ginas
        $this->routes['GET']['/'] = 'PageController@home';
        $this->routes['GET']['/consultores'] = 'PageController@consultores';
        $this->routes['GET']['/consultores/:slug'] = 'PageController@consultorDetalhes';
        $this->routes['GET']['/blog'] = 'PageController@blog';
        $this->routes['GET']['/login'] = 'PageController@login';
        $this->routes['GET']['/registro'] = 'PageController@registro';
        $this->routes['GET']['/creditos'] = 'PageController@creditos';
        $this\->routes['GET']['/dashboard'] = 'PageController@dashboard';\n        \->routes['GET']['/painel-cliente'] = 'PageController@painelCliente';\n        \->routes['GET']['/painel-consultor'] = 'PageController@painelConsultor';\n        \->routes['GET']['/admin'] = 'PageController@admin';
    }
    
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Remover barra final
        $path = rtrim($path, '/') ?: '/';
        
        // Verificar rotas exatas primeiro
        if (isset($this->routes[$method][$path])) {
            $this->callRoute($this->routes[$method][$path]);
            return;
        }
        
        // Verificar rotas com parÃ¢metros
        foreach ($this->routes[$method] as $route => $handler) {
            if ($this->matchRoute($route, $path, $params)) {
                $this->callRoute($handler, $params);
                return;
            }
        }
        
        // 404
        http_response_code(404);
        include ROOT_PATH . '/views/404.php';
    }
    
    private function matchRoute($route, $path, &$params) {
        $params = [];
        $routePattern = preg_replace('/:(\w+)/', '([^/]+)', $route);
        $routePattern = '#^' . $routePattern . '$#';
        
        if (preg_match($routePattern, $path, $matches)) {
            array_shift($matches);
            preg_match_all('/:(\w+)/', $route, $paramNames);
            foreach ($paramNames[1] as $index => $name) {
                $params[$name] = $matches[$index] ?? null;
            }
            return true;
        }
        
        return false;
    }
    
    private function callRoute($handler, $params = []) {
        list($controller, $method) = explode('@', $handler);
        $controllerObj = new $controller();
        $controllerObj->$method($params);
    }
}
