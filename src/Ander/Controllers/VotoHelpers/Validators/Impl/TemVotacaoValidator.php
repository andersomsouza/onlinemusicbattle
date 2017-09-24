<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 11/09/17
 * Time: 21:43
 */

namespace Ander\Controllers\VotoHelpers\Validators\Impl;


use Ander\Battle;
use Ander\Controllers\VotoHelpers\Validators\ValidatorAbstract;
use Ander\Controllers\VotoHelpers\Resposta;

class TemVotacaoValidator extends ValidatorAbstract
{

    public function valida(Battle $battle = null, $voteNumber)
    {
        if(empty($battle)) return new Resposta("Nenhuma votação em andamento",503);
        else if(is_null($this->proximo)) return true; else return $this->proximo->valida($battle, $voteNumber);
    }
}