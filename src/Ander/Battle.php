<?php
/**
 * Created by PhpStorm.
 * User: Anderson
 * Date: 11/09/2017
 * Time: 13:41
 */

namespace Ander;

use Ander\States\EstadoEmAndamento;

class Battle
{
    private $musicas;
    private $estado;
    private $id;
    /**
     * Battle constructor.
     * @param $musica1
     * @param $musica2
     */
    public function __construct( $musica1, $musica2)
    {
        $this->musicas = array();
        $this->musicas[] = new Musica($musica1);
        $this->musicas[] = new Musica($musica2);
        $this->estado = new EstadoEmAndamento();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Musica
     */
    public function getMusica1()
    {
        return $this->musicas[0];
    }

    /**
     * @return Musica
     */
    public function getMusica2()
    {
        return $this->musicas[1];
    }

    /**
     * @return array
     */
    public function getMusicas()
    {
        return $this->musicas;
    }

    public function getMusica($index)
    {
        return $this->musicas[$index];
    }

    public function teste(){
        return "Foi!";

    }

    /**
     * @return EstadoEmAndamento
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param EstadoEmAndamento $estado
     */
    public function setEstado(Estado $estado)
    {
        $this->estado = $estado;
    }

    public function __toString() {
        return $this->id;
    }


}