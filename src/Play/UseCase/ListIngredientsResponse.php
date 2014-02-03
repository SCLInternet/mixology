<?php
/**
 * Created by PhpStorm.
 * User: fee
 * Date: 03/02/14
 * Time: 15:34
 */

namespace Play\UseCase;


class ListIngredientsResponse {

    private $list;

    public function __construct()
    {
        $this->list = [];
    }

    public function getIngredients()
    {
        return $this->list;
    }

    public function addIngredientName($name)
    {
        $this->list[] = ['name' => $name];
    }

    public function getCount()
    {
        return count($this->list);
    }
}
