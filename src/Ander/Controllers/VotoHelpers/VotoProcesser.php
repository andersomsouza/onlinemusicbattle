<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 11/09/17
 * Time: 21:30
 */

namespace Ander\Controllers\VotoHelpers;
use Ander\Controllers\VotoHelpers\Validators\Impl\TemVotacaoValidator;
use Ander\Controllers\VotoHelpers\Validators\Impl\MusicaSelecionadaExisteValidator;
use Ander\Controllers\VotoHelpers\Validators\Impl\JaVotouValidator;


class VotoProcesser
{
    private $validator;

    /**
     * Processer constructor.
     */
    public function __construct()
    {
        $this->validator = new TemVotacaoValidator(new MusicaSelecionadaExisteValidator(new JaVotouValidator()));
    }

    public function validar($battle, $voteNumber){
        return $this->validator->valida($battle,$voteNumber);
    }

}