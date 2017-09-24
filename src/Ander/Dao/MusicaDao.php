<?php
/**
 * Created by PhpStorm.
 * User: Anderson
 * Date: 11/09/2017
 * Time: 16:23
 */

namespace Ander\Dao;


use Ander\Musica;

class MusicaDao
{
    public function votar(Musica $musica){
        $conn = ConnectionFactory::getInstance()->getConnection();
        $conn->query("UPDATE musicas SET votos = votos + 1 WHERE id={$musica->getId()}");

        $conn->close();
    }
}