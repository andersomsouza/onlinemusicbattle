<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 11/09/17
 * Time: 21:45
 */

namespace Ander\Controllers\VotoHelpers;


use Ander\Battle;

class MusicaSelecionadaExisteValidator extends ValidatorAbstract
{

    public function valida(Battle $battle = null, $voteNumber)
    {
        if ($voteNumber > count($battle->getMusicas())) {
            return new Resposta("Indice incorreto!", 503);
        } else if(is_null($this->proximo)) return true; else return $this->proximo->valida($battle, $voteNumber);
    }
}