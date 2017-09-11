<?php
/**
 * Created by PhpStorm.
 * User: Anderson
 * Date: 11/09/2017
 * Time: 16:37
 */

namespace Ander\Dao;


use Ander\Battle;
use Ander\EstadoEncerrado;
use Ander\Jurado;

class BattleFactory
{
    public function parseBattle($result){
        $batalhas = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $battle = new Battle($row["musica1"],$row["musica2"]);
                $battle->setId($row["ID"]);
                $battle->getMusica1()->setVotos(intval($row["votos1"]));
                $battle->getMusica1()->setId(intval($row["musica1_id"]));
                $battle->getMusica2()->setVotos(intval($row["votos2"]));
                $battle->getMusica2()->setId(intval($row["musica2_id"]));
                if($row["finalizado"] == "1"){
                    $jurado = new Jurado($battle);
                    $battle->setEstado(new EstadoEncerrado($jurado->getMaisVotado()));
                }

                $batalhas[] = $battle;
            }
        }

        return $batalhas;
    }
}