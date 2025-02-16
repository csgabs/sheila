<?php 
#Página para excluir um jogador

namespace App\view;

use App\controller\JogadorController;
//require_once(__DIR__ . "/../../controller/JogadorController.php");

//Captura o parâmetro GET com o ID do jogador
$id = 0;
if(isset($_GET['id']) && is_numeric($_GET['id']))
    $id = $_GET['id'];

//Verifica se o jogador existe
$jogadorCont = new JogadorController();
$jogador = $jogadorCont->buscarPorId($id);

if($jogador) {
    //Excluir
    $erros = $jogadorCont->excluir($id);

    //Redirecionar
    header("location: listar.php");
    exit;

} else {
    echo "Jogador não encontrado!<br>";
    echo "<a href='listar.php'>Voltar</a>";
}
