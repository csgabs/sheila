<?php

namespace App\view;

use App\model\Jogador;
use App\model\Jogo;
use App\controller\JogadorController;

/*include_once(__DIR__ . "/../../model/Jogador.php");
include_once(__DIR__ . "/../../controller/JogadorController.php");*/

$msgErro = "";
$jogador = null;

$jogadorCont = new JogadorController();

if(isset($_POST['nome'])) {
    //Se o usuário já clicou no gravar (submeteu o formulário)

    //Capturar os dados preenchidos no formulário
    $id = $_POST['id'];
    $nomejogador = trim($_POST['nome']) ? trim($_POST['nome']) : null;
    $apelido = trim($_POST['apelido']) ? trim($_POST['apelido']) : null;
    $idade = is_numeric($_POST['idade']) ? $_POST['idade'] : null;
    $contextra = trim($_POST['contextra']) ? trim($_POST['contextra']) : null;
    $plataforma = trim($_POST['plataforma']) ? trim($_POST['plataforma']) : null;
    $jogo = is_numeric($_POST['jogo']) ? $_POST['jogo'] : null;

    //Criar o objeto Jogaodor
    $jogador = new Jogador();
    $jogador->setId($id);
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
    $erros = $jogadorCont->alterar($jogador);

    if(empty($erros)) {
        //Redireciona para a listagem
        header("location: listar.php");
        exit;
    } else
        $msgErro = implode("<br>", $erros);
} else {
    //O usuário ainda não clicou no gravar
    $id = 0;
    if(isset($_GET['id']))
        $id = $_GET['id'];

    //Carregar os dados do jogador
    $jogador = $jogadorCont->buscarPorId($id);

    //Validar se o jogador existe
    if(! $jogador) {
        echo "Jogador não encontrado!<br>";
        echo "<a href='listar.php'>Voltar</a>";
        exit;
    }
}

//Incluir o formulário
include_once(__DIR__ . "/form.php");
