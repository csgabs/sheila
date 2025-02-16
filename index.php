<?php
    //Redireciona para a listagem de jogadores
    require __DIR__ . '/vendor/autoload.php';

use App\controller\JogadorController;

$controller = new JogadorController();
$controller->listar();
$listaDeJogadores = $controller->listar();
$arrayJogadores = array_map(fn($jogador) => get_object_vars($jogador), $listaDeJogadores);
echo json_encode($arrayJogadores);
//sheila
