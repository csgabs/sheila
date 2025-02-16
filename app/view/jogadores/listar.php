<?php

namespace App\view;

use App\controller\JogadorController;
//include_once(__DIR__ . "/../../controller/JogadorController.php");

//Carregar a lista de jogadores
$jogadorCont = new JogadorController();
$jogadores = $jogadorCont->listar();
//print_r($jogadores);

//header da página
include_once(__DIR__ . "/../include/header.php");
?>

<h2>Listagem de jogadores</h2>

<div>
    <a href="inserir.php">Inserir</a>
</div>

<table border="1">
    <tr>
        <th>Nome</th>
        <th>Apelido</th>
        <th>Idade</th>
        <th>Plataforma</th>
        <th>Conteúdo extra</th>
        <th>Jogo</th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach($jogadores as $jogador): ?>
        <tr>
            <td><?= $jogador->getNomeJogador() ?></td>
            <td><?= $jogador->getApelido() ?></td>
            <td><?= $jogador->getIdade() ?></td>
            <td><?= $jogador->getPlataforma() ?></td>
            <td><?= $jogador->getContExtraTexto() ?></td>
            <td><?= $jogador->getJogo() ?></td>
            <td>
                <a href="alterar.php?id=<?= $jogador->getId() ?>" >
                    <img src="../../img/btn_editar.png">
                </a>
            </td>
            <td>
                <a href="excluir.php?id=<?= $jogador->getId() ?>"
                    onclick="return confirm('Confirma a exclusão do jogador?');">
                    <img src="../../img/btn_excluir.png">
                </a>
            </td>
        </tr>

    <?php endforeach; ?>

</table>
    
<?php
include_once(__DIR__ . "/../include/footer.php");
?>