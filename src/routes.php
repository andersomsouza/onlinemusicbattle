<?php
// Routes
use \Ander\Battle;
use \Ander\Dao\BattleDao;

$app->get('/', function ($request, $response) {
    $battleDao = new BattleDao();
    $battleAndamento = $battleDao->carregarBatalhaEmAndamento();
    $battleFinalizada = $battleDao->carregarUltimaBatalhaFinalizada();
    return $this->view->render($response, 'principal.phtml', array('battle' => $battleAndamento, 'battleFinalizada' => $battleFinalizada));


});
$app->get('/admin', 'Ander\Controllers\AdminController:adminIndex')->setName('admin');
$app->get('/admin/install', function ($request, $response) {
    $battleDao = new BattleDao();
    $battleDao->instalarBatalhasDao();
    $battleDao->adicionarBatalha(new Battle("Chitãozinho e chororó - Evidencias", "Rafaga - Mentirosa"));

});
$app->get('/admin/battle/{battle}/encerrar', 'Ander\Controllers\AdminController:encerrarBatalha');
$app->get('/admin/battle/{battle}/deletar', 'Ander\Controllers\AdminController:deletarBatalha');
$app->post('/admin/battle', 'Ander\Controllers\AdminController:adicionarBatalha');

$app->post('/{musica:[1,2]}/votar', "Ander\Controllers\VotoController:votar");
$app->post('/', "Ander\Controllers\ApiController:all");

