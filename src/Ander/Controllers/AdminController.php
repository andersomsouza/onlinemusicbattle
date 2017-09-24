<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 23/09/17
 * Time: 23:33
 */
namespace Ander\Controllers;
use Ander\Dao\BattleDao;
use Ander\Battle;
use Psr\Container\ContainerInterface;

class AdminController
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    function adminIndex($request, $response) {
        $battleDao = new BattleDao();
        $battleEmAndamento = $battleDao->carregarBatalhaEmAndamento();
        $battles = $battleDao->carregarTodasBatalhas();

        return $this->container['view']->render($response, 'admin.phtml', array('battleEmAndamento' => $battleEmAndamento, 'battles' => $battles));


    }
    function encerrarBatalha($request, $response, $args)
    {
        $battle = new Battle("", "");
        $battle->setId($args['battle']);
        (new BattleDao())->encerrarBatalha($battle);
        $this->container['flash']->addMessage("success", "Batalha encerrada com sucesso!");
        return $response->withRedirect(  $this->container['router']->pathFor('admin'));

    }

    function deletarBatalha($request, $response, $args)
    {
        $battle = new Battle("", "");
        $battle->setId($args['battle']);
        (new BattleDao())->deletarBatalha($battle);
        $this->container['flash']->addMessage("success", "Batalha Deletada com sucesso!");
        return $response->withRedirect(  $this->container['router']->pathFor('admin'));
    }

    function adicionarBatalha($request, $response)
    {
        $battle = new Battle($request->getParsedBody()['musica1'], $request->getParsedBody()['musica2']);
        (new BattleDao())->adicionarBatalha($battle);
        $this->container['flash']->addMessage("success", "Batalha adicionada!");
        return $response->withRedirect($this->container['router']->pathFor('admin'));
    }
}