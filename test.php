<?php
require __DIR__ . '/vendor/autoload.php';

use App\controller\JogadorController;

$controller = new JogadorController();
$controller->listar();
