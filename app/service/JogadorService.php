<?php

namespace App\service;

use App\model\Jogador;
//include_once(__DIR__ . "/../model/Jogador.php");

class JogadorService {

    public function validar(Jogador $jogador) {
        $erros = array();

        if(! $jogador->getNomeJogador())
            array_push($erros, "Informe o nome!");

        if(! $jogador->getApelido())
            array_push($erros, "Informe o apelido!");

        if(! $jogador->getIdade())
            array_push($erros, "Informe a idade!");

        else if($jogador->getIdade() < 12)
            array_push($erros, "O jogador deve ter no mínimo 12 anos!"); 

        if(! $jogador->getPlataforma())
            array_push($erros, "Informe a plataforma!");

        if(! $jogador->getContExtra())
            array_push($erros, "Informe se o jogador utiliza conteudo extra!");

        if(! $jogador->getJogo())
            array_push($erros, "Informe o Jogo!");
        
        return count($erros) > 0 ? $erros : false;
    }

}