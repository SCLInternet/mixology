<?php
/**
 * Created by PhpStorm.
 * User: fee
 * Date: 03/02/14
 * Time: 14:34
 */

namespace Play\MockDB\Entity;


use Play\Entity\Ingredient;

class MockIngredient extends Ingredient {

    private $name;
    private $id;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}