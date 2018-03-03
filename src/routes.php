<?php
// Routes
use \Ander\Battle;
use \Ander\Dao\BattleDao;

$app->get('/', function ($request, $response) {
    $battleDao = new BattleDao();
    //$battleAndamento = $battleDao->carregarBatalhaEmAndamento();
    return $this->view->render($response, 'principal.phtml');


})->setName('index');
$app->get('/teste', function($request, $response){
    return 'TESTE';
})->add('Ander\Middleware\AuthMiddleware');

$app->group('/admin', function ()  {
    $this->get('[/]', 'Ander\Controllers\AdminController:adminIndex')->setName('admin');
    $this->get('/install', function ($request, $response) {
        $battleDao = new BattleDao();
        $battleDao->instalarBatalhasDao();
        $battleDao->adicionarBatalha(new Battle("Chitãozinho e chororó - Evidencias", "Rafaga - Mentirosa"));

    });
    $this->get('/logout', function ($request, $response) {
        return $response->withStatus(401)->write("<script>window.location.href = '{$this->router->pathFor('index')}'</script>");
    });
    $this->get('/battle/{battle}/encerrar', 'Ander\Controllers\AdminController:encerrarBatalha');
    $this->get('/battle/{battle}/deletar', 'Ander\Controllers\AdminController:deletarBatalha');
    $this->post('/battle', 'Ander\Controllers\AdminController:adicionarBatalha');
})->add('Ander\Middleware\AuthMiddleware');

$app->post('/{musica:[1,2]}/votar', "Ander\Controllers\VotoController:votar");
$app->post('/', "Ander\Controllers\ApiController:all");

