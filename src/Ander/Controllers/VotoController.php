<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 11/09/17
 * Time: 21:00
 */

namespace Ander\Controllers;

use Ander\Dao\BattleDao;
use Ander\Dao\MusicaDao;
use Psr\Container\ContainerInterface;
use Ander\Controllers\VotoHelpers\Processer;
use Ander\Controllers\VotoHelpers\Resposta;

class VotoController
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function votar($request, $response, $args)
    {
        $voteNumber = intval($args['musica']) -1;

        $batalha = (new BattleDao())->carregarBatalhaEmAndamento();
        $validator = new Processer();
        $resposta = $validator->validar($batalha, $voteNumber);

        if (!($resposta instanceof Resposta)) {
            (new MusicaDao())->votar($batalha->getMusicas()[$voteNumber]);
            $resposta = new Resposta("Voto Computado", 200);
        }

        return $response->withJson($resposta->getArray(), 201);
    }
}