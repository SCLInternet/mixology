<?php

namespace Play\UseCase;

use Play\Repository\IngredientRepository;

class ListIngredientsUC
{

    private $ingredientRepository;

    public function execute(ListIngredientsRequest $request)
    {
        $ingredients = $this->ingredientRepository->getAll();
        $response = new ListIngredientsResponse($ingredients);

        return $response;
    }

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }
}
