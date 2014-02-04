<?php

namespace Play\UseCase;

class ListIngredientsResponse
{
    /**
     * @var mixed[][]
     */
    private $list = [];

    /**
     * @return mixed[][]
     */
    public function getIngredients()
    {
        return $this->list;
    }

    /**
     * @param string $name
     */
    public function addIngredientName($name)
    {
        $this->list[] = ['name' => $name];
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return count($this->list);
    }
}
