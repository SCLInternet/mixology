<?php
namespace Play\Entity;

abstract class Ingredient
{
    /**
     * @param string $name
     */
    abstract public function setName($name);

    /**
     * @return string
     */
    abstract public function getName();

    /**
     * @return int
     */
    abstract public function getId();
}
