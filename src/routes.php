<?php
// Routes
use \Ander\Battle;
use \Ander\Dao\BattleDao;

$app->get('/', function ($request, $response) {
    $battle = (new BattleDao())->carregarBatalhaEmAndamento();
    return $this->view->render($response, 'index.phtml', array('battle'=>$battle));


});
$app->get('/admin', function ($request, $response) {
    $battleDao = new BattleDao();
    $battleEmAndamento = $battleDao->carregarBatalhaEmAndamento();
    $battles = $battleDao->carregarTodasBatalhas();
    return $this->view->render($response, 'admin.phtml',array('battleEmAndamento'=>$battleEmAndamento, 'battles'=>$battles));


});
$app->get('/teste', function ($request, $response) {
    $battleDao = new BattleDao();
    $battleDao->adicionarBatalha(new Battle("Chitãozinho e chororó - Evidencias","Rafaga - Mentirosa"));

});
$app->get('/admin/battle/{battle}/encerrar', function ($request, $response, $args) {
    $battle = new Battle();
    $battle->setId($args['battle']);
    (new BattleDao())->encerrarBatalha($battle);

});
$app->get('/admin/battle/{battle}/deletar', function ($request, $response) {

});
$app->post('/admin/battle/{battle}', function ($request, $response) {

});

$app->post('/{musica:[1,2]}/votar', "Ander\Controllers\VotoController:votar");
$app->post('/', "Ander\Controllers\ApiController:all");

