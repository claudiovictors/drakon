<?php

namespace Drakon\Core\Https;

use Exception;

class Router {

    private array $routes = [];

    /**
     * Adiciona uma nova rota ao sistema de roteamento.
     *
     * @param string $method HTTP da rota como (GET, POST, PUT etc).
     * @param string $path O caminho da URL que a rota deve corresponser
     * @param callable|array $handle O manipulador que será chamado quando a rota corresponder.
     * @return void
     */
    public function add(string $method, string $path, callable|array $handle): void {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path'   => $path,
            'handle' => $handle
        ];
    }

    /**
     * Adiciona uma nova rota para o método GET
     *
     * @param string $path $path O caminho da URL que a rota deve corresponser
     * @param callable|array $handle $handle O manipulador que será chamado quando a rota corresponder.
     * @return void
     */
    public function get(string $path, callable|array $handle): void {
        $this->add('GET', $path, $handle);
    }

    /**
     * Adiciona uma nova rota para o método POST
     *
     * @param string $path $path O caminho da URL que a rota deve corresponser
     * @param callable|array $handle $handle O manipulador que será chamado quando a rota corresponder.
     * @return void
     */
    public function post(string $path, callable|array $handle): void {
        $this->add('POST', $path, $handle);
    }

    /**
     * Adiciona uma nova rota para o método PUT
     *
     * @param string $path $path O caminho da URL que a rota deve corresponser
     * @param callable|array $handle $handle O manipulador que será chamado quando a rota corresponder.
     * @return void
     */
    public function put(string $path, callable|array $handle): void {
        $this->add('PUT', $path, $handle);
    }

    /**
     * Adiciona uma nova rota para o método DELETE
     *
     * @param string $path $path O caminho da URL que a rota deve corresponser
     * @param callable|array $handle $handle O manipulador que será chamado quando a rota corresponder.
     * @return void
     */
    public function delete(string $path, callable|array $handle): void {
        $this->add('DELETE', $path, $handle);
    }

    /**
     * Dispacha a requisição para a rota correspondente.
     *
     * @return void
     */
    
     public function dispatch() {
        // Captura o método HTTP da requisição
        $method_type = $_SERVER['REQUEST_METHOD'];
    
        // Processa a URL da requisição para obter o caminho
        $uri_path = htmlspecialchars(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), ENT_QUOTES, 'UTF-8');
    
        foreach ($this->routes as $route) {
            // Transforma partes dinâmicas da rota em padrões de expressão regulares
            $pattern = preg_replace('/:(\w+)/', '(?P<\1>[^/]+)', $route['path']);
    
            // Verifica se o método e o caminho da URL correspondem à rota definida
            if ($route['method'] === $method_type && preg_match('#^' . $pattern . '$#', $uri_path, $matches)) {
                // Filtra os parâmetros capturados para manter apenas os nomeados
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
    
                if (is_callable($route['handle'])) {
                    // Passa os parâmetros capturados para o Request e executa o handler
                    call_user_func($route['handle'], new Request($params), new Response());
                    return;
                } elseif (is_array($route['handle'])) {
                    // Se o handler é uma array [classe, método], instancia e executa
                    [$currentController, $methodAction] = $route['handle'];
                    call_user_func_array([new $currentController, $methodAction], $params);
                    return;
                } else {
                    throw new Exception('Invalid handler. Must be callable or an array.');
                }
            }
        }
    
        // Retorna erro 404 se nenhuma rota corresponder
        http_response_code(404);
        echo 'Error 404 - Page not found!';
    }
    
    
}