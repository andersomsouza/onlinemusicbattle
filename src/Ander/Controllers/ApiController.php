<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 11/09/17
 * Time: 23:00
 */

namespace Ander\Controllers;


use Ander\Dao\BattleDao;
use Psr\Container\ContainerInterface;

class ApiController
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function all($request, $response, $args)
    {
        $battleDao = new BattleDao();
        $battle = $battleDao->carregarBatalhaEmAndamento();
        $battleFinalizada = $battleDao->carregarUltimaBatalhaFinalizada();

        $resposta = array();
        $resposta['musicas'] = array();
        if (!is_null($battle)) {
            $porcentagemVoto1 = 0;
            $porcentagemVoto2 = 0;
            $totalDeVotos = $battle->getMusica1()->getVotos() + $battle->getMusica2()->getVotos();
            $porcentagemVoto1 = 100 * $battle->getMusica1()->getVotos() / $totalDeVotos;
            $porcentagemVoto2 = 100 * $battle->getMusica2()->getVotos() / $totalDeVotos;
            $resposta['musicas'][$battle->getMusica1()->getNome()] = "${porcentagemVoto1} %";
            $resposta['musicas'][$battle->getMusica2()->getNome()] = "${porcentagemVoto2} %";
            $resposta['ultimaVitoria'] = (!empty($battleFinalizada)) ? $battleFinalizada->getMusicaVencedora() : "";
        }
        if (isset($_SESSION['last_vote']) && $_SESSION['last_vote'] == $battle->getId()) {
            $resposta['ja_votou'] = true;
        } else {
            $resposta['ja_votou'] = false;
        }
        return $response->withJson($resposta);
    }
}