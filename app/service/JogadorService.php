<?php

namespace App\service;

use App\model\Jogador;
//include_once(__DIR__ . "/../model/Jogador.php");

class JogadorService {

    public function validar(Jogador $jogador) {

        if(! $jogador->getNomeJogador())
            return "Informe o nome!";

        if(! $jogador->getApelido())
            return "Informe o apelido!";

        if(! $jogador->getIdade())
            return "Informe a idade!";

        else if($jogador->getIdade() < 12)
            return "O jogador deve ter no mínimo 12 anos!"; 

        if(! $jogador->getPlataforma())
            return "Informe a plataforma!";

        if(! $jogador->getContExtra())
            return "Informe se o jogador utiliza conteudo extra!";

        if(! $jogador->getJogo())
            return "Informe o Jogo!";
        
        return null;
    }

}