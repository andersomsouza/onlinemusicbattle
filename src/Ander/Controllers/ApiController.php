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

    public function all($request, $response, $args){
        $battleDao = new BattleDao();
        $battle = $battleDao->carregarBatalhaEmAndamento();
        $resposta = array();
        $resposta['musicas'] = array(
        );
        if(!is_null($battle)){
            $resposta['musicas'][$battle->getMusica1()->getNome()]=$battle->getMusica1()->getVotos();
            $resposta['musicas'][$battle->getMusica2()->getNome()]=$battle->getMusica2()->getVotos();
        }
        if(isset($_SESSION['last_vote'])&&$_SESSION['last_vote']==$battle->getId()){
            $resposta['ja_votou'] = true;
        }else{
            $resposta['ja_votou'] = false;
        }
        return $response->withJson($resposta);
    }
}