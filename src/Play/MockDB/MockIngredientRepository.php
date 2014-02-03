<?php
/**
 * Created by PhpStorm.
 * User: fee
 * Date: 03/02/14
 * Time: 14:29
 */

namespace Play\MockDB;

use Play\Entity\Ingredient;
use Play\Repository\IngredientRepository;
use Play\MockDB\Entity\MockIngredient;

class MockIngredientRepository implements IngredientRepository
{
    private $entities = [];

    public function __construct()
    {
        $this->createIngredient('rum');
        $this->createIngredient('gin');
        $this->createIngredient('vodka');
    }

    public function create()
    {
        return new MockIngredient();
    }

    public function save(Ingredient $ingredient)
    {
        $ingredient->setId(count($this->entities) + 1);

        $this->entities[] = $ingredient;
    }

    public function getAll()
    {
        return $this->entities;
    }

    /**
     * @param $name
     * @return \Play\MockDB\Entity\MockIngredient
     */
    private function createIngredient($name)
    {
        $ingredient = new MockIngredient();
        $ingredient->setName($name);

        $this->save($ingredient);
    }
}