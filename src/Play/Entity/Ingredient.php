<?php
namespace Play\Entity;

abstract class Ingredient {

    abstract public function setName($name);
    abstract public function getName();
    abstract public function getId();

}
