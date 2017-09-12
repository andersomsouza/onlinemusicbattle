<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 11/09/17
 * Time: 21:43
 */

namespace Ander\Controllers\VotoHelpers;


use Ander\Battle;

class TemVotacaoValidator extends ValidatorAbstract
{

    public function valida(Battle $battle = null, $voteNumber)
    {
        if(empty($battle)) return new Resposta("Nenhuma votação em andamento",0);
        else if(is_null($this->proximo)) return true; else return $this->proximo->valida($battle, $voteNumber);
    }
}