<?php
// Routes
use \Ander\Battle;
use \Ander\Dao\BattleDao;

$app->get('/', function ($request, $response) {
    // Sample log messag
    $battle = (new BattleDao())->carregarBatalhaEmAndamento();
    return $this->view->render($response, 'index.phtml', array('battle'=>$battle));


});

$app->get('/teste', function ($request, $response) {
    $battleDao = new BattleDao();
    $battleDao->adicionarBatalha(new Battle("Chitãozinho e chororó - Evidencias","Rafaga - Mentirosa"));

});


$app->post('/{musica:[1,2]}/votar', "Ander\Controllers\VotoController:votar");
$app->post('/', "Ander\Controllers\ApiController:all");
