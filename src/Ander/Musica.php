<?php
/**
 * Created by PhpStorm.
 * User: Anderson
 * Date: 11/09/2017
 * Time: 13:49
 */

namespace Ander;


class Musica
{
    private $votos;
    private $nome;
    private $id;

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
     * Musica constructor.
     * @param $votos
     */
    public function __construct($nome)
    {
        $this->nome = $nome;
        $this->votos = 0;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }


    public function getVotos(){
        return $this->votos;
    }

    public function setVotos($votos){
       $this->votos = $votos;
    }

}