<?php
/**
 * Created by PhpStorm.
 * User: Anderson
 * Date: 11/09/2017
 * Time: 13:59
 */

namespace Ander\States;


use Prophecy\Exception\Exception;

class EstadoEncerrado implements Estado
{

    private $musica;


    /**
     * EstadoEncerrado constructor.
     */
    public function __construct(Musica $musica)
    {
        $this->musica = $musica;
    }

    public function encerrar(Battle $battle)
    {
        throw new \Exception("Impossivel encerrar");
    }

    public function isEncerrado()
    {
        return true;
    }

    public function getVencedor()
    {
        return $this->musica;
    }
}