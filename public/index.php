<?php

/**
 * Arquivo de inicialização do Drakon
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Drakon\Core\Https\Router;
use Drakon\Core\Https\Request;
use Drakon\Core\Https\Response;

$routes = new Router();

$routes->add('GET', '/users/:id', function(Request $req, Response $resp) use ($response) {
    $id = $req->param('id');
    $users = [
        'id' => $id,
        'name' => 'Cláudio Victor',
        'email' => 'claudio@gmail.com'
    ];

    if(!$users){
        return $resp->status(404)->json(['message' => 'Usuário não encontrado']);
    }

    return $resp->status(200)->json($users);
});

$routes->dispatch();