<?php
/**
 * Created by PhpStorm.
 * User: fee
 * Date: 03/02/14
 * Time: 15:34
 */

namespace Play\UseCase;

use Play\Entity\Ingredient;

class ListIngredientsResponse {

    private $list = [];

    /**
     * @param Ingredient[] $ingredients
     */
    public function __construct(array $ingredients)
    {
        foreach ($ingredients as $ingredient) {
            $this->addIngredientName($ingredient->getName());
        }
    }

    public function getIngredients()
    {
        return $this->list;
    }

    public function getCount()
    {
        return count($this->list);
    }

    private function addIngredientName($name)
    {
        $this->list[] = ['name' => $name];
    }
}
