<?php

namespace App\controller;

use App\dao\JogadorDAO;
use App\service\JogadorService;
use App\model\Jogador;


class JogadorController {

    private JogadorDAO $jogadorDao;
    private JogadorService $jogadorService;

    public function __construct() {
        $this->jogadorDao = new JogadorDAO();
        $this->jogadorService = new JogadorService();
    }

    public function listar() {
        $jogadores = $this->jogadorDao->list();
        return $jogadores;
    }

    public function buscarPorId(int $id) {
        $jogador = $this->jogadorDao->findById($id);
        return $jogador;
    }

    public function inserir(Jogador $jogador) {
        $erros = $this->jogadorService->validar($jogador);
        //print_r($erros);

        if(!empty($erros))
            return $erros;

        $this->jogadorDao->insert($jogador);
        return array();
    }

    public function alterar(Jogador $jogador) {
        $erros = $this->jogadorService->validar($jogador);
        if($erros)
            return $erros;

        $this->jogadorDao->update($jogador);
        return array();
    }

    public function excluir(int $id) {
        $this->jogadorDao->delete($id);
    }

}