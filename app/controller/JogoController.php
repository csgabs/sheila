<?php

namespace App\controller;

use App\dao\JogoDAO;

//include_once(__DIR__ . "/../dao/JogoDAO.php");

class JogoController {

    private JogoDAO $jogoDao;

    public function __construct() {
        $this->jogoDao = new JogoDAO();
    }

    public function listar() {
        $jogos = $this->jogoDao->list();
        return $jogos;
    }

}