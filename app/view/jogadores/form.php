<?php
#Página com o formulário de alunos

namespace App\view;
use App\controller\JogoController;
//include_once(__DIR__ . "/../../controller/JogoController.php");

$jogoCont = new JogoController();
$jogos = $jogoCont->listar();
//print_r($jogos);

//Inclui o HEADER
require_once(__DIR__ . "/../include/header.php");
?> 

<h3>FORMULÁRIO DE JOGADOR</h3>

<form name="frmCadastroJogadores" method="POST" >
    <div>
        <label for="txtNomeJogador">Nome:</label>
        <input type="text" id="txtNome" name="nome" 
            size="45" maxlength="70" 
            value="<?= ($jogador ? $jogador->getNomeJogador() : '') ?>" />
    </div>
    <div>
    <label for="apelido">Apelido:</label>
        <input type="text" id="apelido" name="apelido" 
            size="45" maxlength="30" 
            value="<?= ($jogador ? $jogador->getApelido() : '') ?>" />

    </div>

    <div>
        <label for="txtIdade">Idade:</label>
        <input type="number" id="txtIdade" name="idade"
            value="<?= ($jogador ? $jogador->getIdade() : '') ?>" />
    </div>

    <div >
        <label for="selCextra">costuma comprar conteúdos extras (DLCs, skins, etc.)?</label>
        <select id="selCextra" name="contextra">
            <option value="">---Selecione---</option>
            <option value="S"
                <?= ($jogador && $jogador->getContExtra() == 'S' ? 'selected' : '') ?> >
                Sim</option>
            <option value="N"
                <?= ($jogador && $jogador->getContExtra() == 'N' ? 'selected' : '') ?> >
                Não</option>
        </select>
    </div>

    <div >
        <label for="selPlat">Plataforma:</label>
        <select id="selPlat" name="plataforma">
            <option value="">---Selecione---</option>
            <option value="PC"
                <?= ($jogador && $jogador->getPlataforma() == 'PC' ? 'selected' : '') ?> >
                PC</option>
            <option value="Console"
                <?= ($jogador && $jogador->getPlataforma() == 'Console' ? 'selected' : '') ?> >
                Console</option>
            <option value="Mobile"
                <?= ($jogador && $jogador->getPlataforma() == 'Mobile' ? 'selected' : '') ?> >
                Mobile</option>
            <option value="Outro"
                <?= ($jogador && $jogador->getPlataforma() == 'Outro' ? 'selected' : '') ?> >
                Outro</option>
        </select>
    </div>

    <div>
        <label for="selJogo">Jogo favorito:</label>
        <select id="selJogo" name="jogo">
            <option value="">---Selecione---</option>
            <?php foreach($jogos as $j): ?>
                <option value="<?= $j->getId() ?>" 
                    <?= ($jogador && $jogador->getJogo() && 
                        $jogador->getJogo()->getId() == $j->getId() ? "selected" : "" ) ?> >
                <?= $j ?></option>        
            <?php endforeach; ?>
        </select>        
    </div>

    <input type="hidden" name="id" 
        value="<?= ($jogador ? $jogador->getId() : '') ?>">

    <button type="submit">Gravar</button>
</form>

<?php if($msgErro): ?>
    <div id="msgErro" style="color: red;">
        <?= $msgErro ?>
    </div>
<?php endif; ?>

<div>
    <a href="listar.php">Voltar</a>
</div>

<?php 
//Inclui o FOOTER
require_once(__DIR__ . "/../include/footer.php");
?>
