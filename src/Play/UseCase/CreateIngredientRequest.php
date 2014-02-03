<?php
/**
 * Created by PhpStorm.
 * User: fee
 * Date: 03/02/14
 * Time: 11:58
 */

namespace Play\UseCase;


class CreateIngredientRequest implements RequestInterface {

    private $name ;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    static public function fromArray(array $params)
    {
        return new self($params['name']);
    }
}