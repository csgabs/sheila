<?php
require __DIR__ . '/vendor/autoload.php';

use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\controller\JogadorController;
use App\model\Jogador;
use App\model\Jogo;

$app = AppFactory::create();

// Definindo uma rota GET
$app->get('/jogadores/listar', function (Request $request, Response $response) {
    $controller = new JogadorController();
    $listaDeJogadores = $controller->listar();
    $data = [
        "status" => 200,
        "message" => "Jogadores listados com sucesso!",
        "jogadores" => $listaDeJogadores
    ];
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

// Rota para inserir jogador
$app->post('/jogadores/inserir', function (Request $request, Response $response) {
    // Capturar os dados do corpo da requisição
    $rawBody = $request->getBody()->getContents(); // Pega o corpo da requisição
    $dados = json_decode($rawBody, true); // Decodifica o JSON

    // Validação e tratamento dos dados
    $nomejogador = trim($dados['nome']) ?: null;
    $apelido = trim($dados['apelido']) ?: null;
    $idade = is_numeric($dados['idade']) ? $dados['idade'] : null;
    $contextra = trim($dados['contextra']) ?: null;
    $plataforma = trim($dados['plataforma']) ?: null;
    $jogo = is_numeric($dados['jogo']) ? $dados['jogo'] : null;

    // Verificação de campos obrigatórios
    if (!$nomejogador || !$apelido || !$idade || !$plataforma) {
        $data = [
            'status' => 400,
            'message' => 'Campos obrigatórios não preenchidos.'
        ];
    
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // Criar o objeto Jogador
    $jogador = new Jogador();
    $jogador->setId(0);
    $jogador->setNomeJogador($nomejogador);
    $jogador->setApelido($apelido);
    $jogador->setIdade($idade);
    $jogador->setPlataforma($plataforma);
    $jogador->setContExtra($contextra);
    
    // Associar o Jogo, se fornecido
    if ($jogo) {
        $jogoObj = new Jogo();
        $jogoObj->setId($jogo);
        $jogador->setJogo($jogoObj);
    } else {
        $jogador->setJogo(null);
    }

    $jogadorCont = new JogadorController();
    $jogadorCont->inserir($jogador);

    $data = [
        'status' => 201,
        'message' => 'Jogador inserido com sucesso!'
    ];

    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

// Rodando a aplicação
$app->run();
