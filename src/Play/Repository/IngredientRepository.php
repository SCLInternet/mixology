<?php
/**
 * Created by PhpStorm.
 * User: fee
 * Date: 03/02/14
 * Time: 11:44
 */

namespace Play\Repository;


use Play\Entity\Ingredient;

interface IngredientRepository {

    public function create();

    public function save(Ingredient $ingredient);

    public function getAll();
}