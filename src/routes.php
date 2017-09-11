<?php
// Routes
use \Ander\Battle;
use \Ander\Dao\BattleDao;

$app->get('/', function ($request, $response) {
    // Sample log message
    $battle = (new BattleDao())->carregarBatalhaEmAndamento()[0];
    return $this->view->render($response, 'index.phtml', array('battle'=>$battle));


});

$app->post('/{musica}/votar', function ($request, $response, $args) {
    $batalhas = (new BattleDao())->carregarBatalhaEmAndamento();

    if (empty($batalhas)) {
        $resposta = ['resposta' => 'Nenhuma votação em andamento', 'status' => 0];

    } else {
        $batalha = $batalhas[0];
        if (isset($_SESSION['last_vote']) && $_SESSION['last_vote'] == $batalha->getId()) {
            $resposta = ['resposta' => 'Você já votou', 'status' => 403];
        } else
            if ($mus = intval($args['musica'])) {
                $musicaDao = new \Ander\Dao\MusicaDao();
                switch ($mus) {
                    case 1:
                        $musicaDao->votar($batalha->getMusica1());
                        $_SESSION['last_vote'] = $batalha->getId();
                        $resposta = ['resposta' => 'Voto Computado', 'status' => 1];
                        break;
                    case 2:
                        $musicaDao->votar($batalha->getMusica2());
                        $_SESSION['last_vote'] = $batalha->getId();
                        $resposta = ['resposta' => 'Voto Computado', 'status' => 1];
                        break;
                    default:
                        $resposta = ['resposta' => 'Voto Inválido', 'status' => 2];
                        break;

                }
            } else {
                $resposta = ['resposta' => 'Ops!', 'status' => 500];

            }


    }
    return $response->withJson($resposta, 201);
});