<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 11/09/17
 * Time: 21:32
 */

namespace Ander\Controllers\VotoHelpers;


class Resposta
{
    private $descricao;
    private $status;

    /**
     * Resposta constructor.
     * @param $descricao
     * @param $status
     */
    public function __construct($descricao, $status)
    {
        $this->descricao = $descricao;
        $this->status = $status;
    }


    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getArray()
    {
        return array('descricao' => $this->descricao, 'status' => $this->status);
    }
}