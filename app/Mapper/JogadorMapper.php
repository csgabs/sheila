<?php

namespace App\Mapper;

use App\controller\JogadorController;
use App\Model\Jogador;

class JogadorMapper {

    public function mapFromDatabaseArrayToObjectArray($regArray) {
        $arrayObj = array();

        foreach($regArray as $reg) {
            $regObj = $this->mapFromDatabaseToObject($reg);
            array_push($arrayObj, $regObj); 
        }

        return $arrayObj;
    }

    public function mapFromDatabaseToObject($regDatabase) {
        $obj = new Jogador();
        if(isset($regDatabase['id'])) 
            $obj->setId($regDatabase['id']);
        
        if(isset($regDatabase['nome']))
            $obj->setNomeJogador($regDatabase['nome']);

        if(isset($regDatabase['apelido']))
            $obj->setApelido($regDatabase['apelido']);
        
        if(isset($regDatabase['idade']))
            $obj->setIdade($regDatabase['idade']);

        if(isset($regDatabase['contextra']))
            $obj->setContExtra($regDatabase['contextra']);

        if(isset($regDatabase['plataforma']))
            $obj->setPlataforma($regDatabase['plataforma']);

            if(isset($regDatabase['jogo']))
            $obj->setApelido($regDatabase['jogo']);
        
        return $obj;
    }

    public function mapFromJsonToObject($regJson) {
        return $this->mapFromDatabaseToObject($regJson);
    }

}