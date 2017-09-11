<?php
/**
 * Created by PhpStorm.
 * User: Anderson
 * Date: 11/09/2017
 * Time: 13:41
 */

namespace Ander;


class Battle
{
    private $musica1;
    private $musica2;
    private $estado;
    private $id;
    /**
     * Battle constructor.
     * @param $musica1
     * @param $musica2
     */
    public function __construct( $musica1, $musica2)
    {
        $this->musica1 = new Musica($musica1);
        $this->musica2 = new Musica($musica2);
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
        return $this->musica1;
    }

    /**
     * @return Musica
     */
    public function getMusica2()
    {
        return $this->musica2;
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