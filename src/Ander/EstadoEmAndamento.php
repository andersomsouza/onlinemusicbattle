<?php
/**
 * Created by PhpStorm.
 * User: Anderson
 * Date: 11/09/2017
 * Time: 14:02
 */

namespace Ander;


class EstadoEmAndamento implements Estado
{

    public function encerrar(Battle $battle)
    {
        $jurado = new Jurado($battle);
        $musicaMaisVotada = $jurado->getMaisVotado();
        $battle->setEstado(new EstadoEncerrado($musicaMaisVotada));
    }

    public function isEncerrado()
    {
      return false;
    }

    public function getVencedor()
    {
      throw new \Exception("Essa batalha ainda nao foi encerrada.");
    }
}