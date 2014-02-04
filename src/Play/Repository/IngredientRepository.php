<?php

namespace Play\Repository;

use Play\Entity\Ingredient;

interface IngredientRepository
{
    /**
     * @return Ingredient
     */
    public function create();

    public function save(Ingredient $ingredient);

    /**
     * @return Ingredient[]
     */
    public function getAll();
}
