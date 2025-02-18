<?php
//C:\xampp\htdocs\mvc_jogador\index.php

require __DIR__ . '/vendor/autoload.php'; 

use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;
use App\controller\JogadorController;
use App\model\Jogador;
use App\model\Jogo;

$app = AppFactory::create();
$app->setBasePath("/mvc_jogador");

$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, false, false);

$app->get('/jogadores/listar', JogadorController::class . ":listar");
$app->post('/jogadores/inserir', JogadorController::class . ":inserir");

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request, "Esta rota não existe na API!");
});

$app->run();
