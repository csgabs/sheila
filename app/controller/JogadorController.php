<?php

namespace App\controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\dao\JogadorDAO;
use App\Mapper\JogadorMapper;
use App\service\JogadorService;
use App\model\Jogador;

use \PDOException;

class JogadorController {

    private JogadorDAO $jogadorDao;
    private JogadorService $jogadorService;
    private JogadorMapper $jogadorMapper;

    public function __construct() {
        $this->jogadorDao = new JogadorDAO();
        $this->jogadorMapper = new JogadorMapper();
        $this->jogadorService = new JogadorService();
    }

    public function listar(Request $request, Response $response, array $args): Response {
		$jogadores = $this->jogadorDao->list();

		$json = json_encode($jogadores, 
					JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES |
					JSON_UNESCAPED_UNICODE);

		$response->getBody()->write($json);
		
		return $response
					->withStatus(200)
					->withHeader("Content-Type", "application/json");
    }

    public function inserir(Request $request, Response $response, array $args): Response {
		$json = $request->getParsedBody();
		
		$jogador = $this->jogadorMapper->mapFromJsonToObject($json);

		$jogador = $this->jogadorDao->insert($jogador);

		$json = json_encode($jogador, 
					JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES |
					JSON_UNESCAPED_UNICODE);
		

		$response->getBody()->write($json);
		return $response
					->withStatus(201)
					->withHeader("Content-Type", "application/json");
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

/*
    // validação e converte pra json
    $nomejogador = trim($dados['nome']) ?: null;
    $apelido = trim($dados['apelido']) ?: null;
    $idade = is_numeric($dados['idade']) ? $dados['idade'] : null;
    $contextra = trim($dados['contextra']) ?: null;
    $plataforma = trim($dados['plataforma']) ?: null;
    $jogo = is_numeric($dados['jogo']) ? $dados['jogo'] : null;
    
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    $jogador = new Jogador();

    
    // associar o Jogo, se fornecido
    if ($jogo) {
        $jogoObj = new Jogo();
        $jogoObj->setId($jogo);
        $jogador->setJogo($jogoObj);
    } else {
        $jogador->setJogo(null);
    }
*/


