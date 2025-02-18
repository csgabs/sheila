<?php

/*include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Jogo.php");*/

namespace App\dao;

use App\util\Connection;
use App\model\Jogo;

class JogoDAO {

    public function list() {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM jogos ORDER BY nome";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();

        $jogos = $this->mapJogos($result);
        return $jogos;
    }

    private function mapJogos($registros) {
        $jogos = array();

        foreach($registros as $reg) {
            $jogo = new Jogo();
            $jogo->setId($reg["id"]);
            $jogo->setNome($reg["nome"]);
            $jogo->setGenero($reg["genero"]);

            array_push($jogos, $jogo);
        }
        return $jogos;
    }

}