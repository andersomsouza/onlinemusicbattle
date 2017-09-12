<?php
/**
 * Created by PhpStorm.
 * User: Anderson
 * Date: 11/09/2017
 * Time: 13:57
 */

namespace Ander\States;


interface Estado
{
    public function encerrar(Battle $battle);
    public function isEncerrado();
    public function getVencedor();

}