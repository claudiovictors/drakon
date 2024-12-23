# Drakon Framework

**Drakon** é um mini-framework MVC (Model-View-Controller) criado para facilitar o desenvolvimento de aplicações web modernas. Ele utiliza namespaces e Composer para organização de código e gerenciamento de dependências.

## Recursos
- Sistema de rotas simples e eficiente.
- Estrutura organizada baseada no padrão MVC.
- Suporte a Views dinâmicas para renderização de páginas.
- Manipulação de banco de dados integrada.

## Estrutura do Projeto
A estrutura do projeto segue o padrão MVC para melhor organização:

```php
<?php

use Drakon\Core\Router;

Router::get('/', function() {
    return 'Bem-vindo ao Drakon!';
});

Router::get('/about', [AboutController::class, 'index']);

Router::post('/login', [AuthController::class, 'login']);
