<?php
    //Redireciona para a listagem de jogadores
    require __DIR__ . '/vendor/autoload.php';

use App\controller\JogadorController;

$controller = new JogadorController();
$listaDeJogadores = $controller->listar();
echo json_encode($listaDeJogadores);
//sheila
