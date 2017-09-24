<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 11/09/17
 * Time: 21:41
 */

namespace Ander\Controllers\VotoHelpers\Validators;


abstract class ValidatorAbstract implements Validator
{

    protected $proximo;

    /**
     * ValidatorAbstract constructor.
     * @param $proximo
     */
    public function __construct($proximo = null)
    {
        $this->proximo = $proximo;
    }

    public function setProximo(Validator $validator)
    {
        $this->proximo = $validator;
    }


}