<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 11/09/17
 * Time: 21:37
 */

namespace Ander\Controllers\VotoHelpers;


use Ander\Battle;

interface Validator
{
    public function setProximo(Validator $validator);
    public function valida (Battle $battle =null, $voteNumber);
}