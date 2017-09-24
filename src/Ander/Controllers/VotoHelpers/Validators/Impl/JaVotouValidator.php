<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 11/09/17
 * Time: 21:54
 */


namespace Ander\Controllers\VotoHelpers\Validators\Impl;


use Ander\Battle;
use Ander\Controllers\VotoHelpers\Validators\ValidatorAbstract;
use Ander\Controllers\VotoHelpers\Resposta;

class JaVotouValidator extends ValidatorAbstract
{

    public function valida(Battle $battle = null, $voteNumber)
    {
        if (isset($_SESSION['last_vote']) && $_SESSION['last_vote'] == $battle->getId()) return new Resposta("Você já votou",401);
        else if (is_null($this->proximo)) return true; else return $this->proximo->valida($battle, $voteNumber);

    }
}