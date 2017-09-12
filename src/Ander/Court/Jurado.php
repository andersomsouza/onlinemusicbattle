<?php
/**
 * Created by PhpStorm.
 * User: Anderson
 * Date: 11/09/2017
 * Time: 14:03
 */

namespace Ander\Court;


class Jurado
{
    private $battle;
    /**
     * Jurado constructor.
     */
    public function __construct(Battle $battle)
    {
        $this->battle = $battle;
    }

    public function getMaisVotado(){

        return $this->battle->getMusica1()->getVotos() > $this->battle->getMusica2()->getVotos() ? $this->battle->getMusica1() : $this->battle->getMusica2();
    }
}