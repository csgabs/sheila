<?php
#Classe DAO para o model de Jogo

/*include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Jogo.php");*/

namespace App\dao;

use App\util\Connection;
use App\model\Jogo;

class JogoDAO {

    //Método para buscar todos os jogos na base de dados
    public function list() {
        $conn = Connection::getConnection();

        $sql = "SELECT * FROM jogos ORDER BY nome";
        $stm = $conn->prepare($sql);    
        $stm->execute();
        $result = $stm->fetchAll();

        $jogos = $this->mapJogos($result);
        return $jogos;
    }

    //Método que mapeia os registros do banco em objetos Jogo
    private function mapJogos($registros) {
        $jogos = array();

        foreach($registros as $reg) {
            //Para cada registro, criar um objeto Jogo
            $jogo = new Jogo();
            $jogo->setId($reg["id"]);
            $jogo->setNome($reg["nome"]);
            $jogo->setGenero($reg["genero"]);

            array_push($jogos, $jogo);
        }
        return $jogos;
    }

}