<?php

/*include_once(__DIR__ . "/../util/Connection.php");
include_once(__DIR__ . "/../model/Jogador.php");
include_once(__DIR__ . "/../model/Jogo.php");*/

namespace App\dao;

use App\util\Connection;
use App\model\Jogador;
use App\model\Jogo;

class JogadorDAO {

    private $conn;
    private $jogadorMapper;

    public function list() {
        $conn = Connection::getConnection();

        $sql = "SELECT a.*, j.nome nome_jogo, j.genero genero_jogo 
                FROM jogadores a
                JOIN jogos j ON (j.id = a.id_jogo)";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        $jogadores = $this->mapJogadores($result);
        return $jogadores;

    }

    public function findById(int $id) {
        $conn = Connection::getConnection();

        $sql = "SELECT a.*, j.nome nome_jogo, j.genero genero_jogo
                FROM jogadores a
                JOIN jogos j ON (j.id = a.id_jogo)
                WHERE a.id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute(array($id));
        $result = $stm->fetchAll();

        $jogadores = $this->mapJogadores($result);

        if(count($jogadores) > 0)
            return $jogadores[0];
        
        return null;
    }

    public function insert(Jogador $jogador) {
        $sql = 'INSERT INTO jogadores (nomejogador, apelido, idade,plataforma,contextra, id_jogo) VALUES (:nomejogador, :apelido, :idade, :plataforma, :contextra, :id_jogo)';

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue("nomejogador", $jogador->getNomeJogador());
        $stmt->bindValue("apelido", $jogador->getApelido());
        $stmt->bindValue("idade", $jogador->getIdade());
        $stmt->bindValue("plataforma", $jogador->getPlataforma());
        $stmt->bindValue("contextra", $jogador->getContExtra());
        $stmt->bindValue("id_jogo", $jogador->getId());
        $stmt->execute();

        $id = $this->conn->lastInsertId();
        $jogador->setId($id);
        return $jogador;
    }



    public function update(Jogador $jogador) {
        $conn = Connection::getConnection();

        $sql = "UPDATE jogadores 
                SET nomejogador = ?, apelido = ?, idade = ?, plataforma = ?,
                    contextra = ?, id_jogo = ? 
                WHERE id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute(array($jogador->getNomeJogador(), $jogador->getApelido(), $jogador->getIdade(),
                            $jogador->getPlataforma(), $jogador->getContExtra(), 
                            $jogador->getJogo()->getId(),
                            $jogador->getId()));
    }

    public function delete(int $id) {
        $conn = Connection::getConnection();

        $sql = "DELETE FROM jogadores WHERE id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute(array($id));
    }

    private function mapJogadores($registros) {
        $jogadores = array();

        foreach($registros as $reg) {
            $jogador = new Jogador();
            $jogador->setId($reg["id"]);
            $jogador->setNomeJogador($reg["nomejogador"]);
            $jogador->setApelido($reg["apelido"]);
            $jogador->setIdade($reg["idade"]);
            $jogador->setPlataforma($reg["plataforma"]);
            $jogador->setContExtra($reg["contextra"]);

            $jogo = new Jogo();
            $jogo->setId($reg["id_jogo"]);
            $jogo->setNome($reg["nome_jogo"]);
            $jogo->setGenero($reg["genero_jogo"]);
            $jogador->setJogo($jogo);

            array_push($jogadores, $jogador);
        }
        return $jogadores;
    }
    
}
