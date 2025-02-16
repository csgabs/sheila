<?php

namespace App\view;

use App\model\Jogador;
use App\controller\JogadorController;
use App\model\Jogo;

/*include_once(__DIR__ . "/../../model/Jogador.php");
include_once(__DIR__ . "/../../controller/JogadorController.php");*/

$msgErro = "";
$jogador = null;

if(isset($_POST['nome'])) {
    //Se o usuário já clicou no gravar (submeteu o formulário)

    //Capturar os dados preenchidos no formulário
    $nomejogador = trim($_POST['nome']) ? trim($_POST['nome']) : null;
    $apelido = trim($_POST['apelido']) ? trim($_POST['apelido']) : null;
    $idade = is_numeric($_POST['idade']) ? $_POST['idade'] : null;
    $contextra = trim($_POST['contextra']) ? trim($_POST['contextra']) : null;
    $plataforma = trim($_POST['plataforma']) ? trim($_POST['plataforma']) : null;
    $jogo = is_numeric($_POST['jogo']) ? $_POST['jogo'] : null;

    //Criar o objeto Jogador
    $jogador = new Jogador();
    $jogador->setId(0);
    $jogador->setNomeJogador($nomejogador);
    $jogador->setApelido($apelido);
    $jogador->setIdade($idade);
    $jogador->setPlataforma($plataforma);
    $jogador->setContExtra($contextra);
    
    if($jogo) {
        $jogoObj = new Jogo();
        $jogoObj->setId($jogo);
        $jogador->setJogo($jogoObj);
    } else
        $jogador->setJogo(null);

    //print_r($jogador);

    //Chama o controller para inserir o jogador
    $jogadorCont = new JogadorController();
    $erros = $jogadorCont->inserir($jogador);

    if(empty($erros)) {
        //Redireciona para a listagem
        header("location: listar.php");
        exit;
    } else
        $msgErro = implode("<br>", $erros);
}

//Incluir o formulário
include_once(__DIR__ . "/form.php");
