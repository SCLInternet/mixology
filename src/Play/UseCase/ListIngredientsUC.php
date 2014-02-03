<?php

namespace Play\UseCase;

use Play\Repository\IngredientRepository;

class ListIngredientsUC
{

    private $ingredientRepository;

    public function execute(ListIngredientsRequest $request)
    {
        $ingredients = $this->ingredientRepository->getAll();

        $response = new ListIngredientsResponse();
        foreach ($ingredients as $ingredient) {
            $response->addIngredientName($ingredient->getName());
        }

        return $response;
    }

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }
}
