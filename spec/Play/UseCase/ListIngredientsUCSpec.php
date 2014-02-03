<?php

namespace spec\Play\UseCase;

use PhpSpec\ObjectBehavior;
use Play\Entity\Ingredient;
use Play\Repository\IngredientRepository;
use Play\UseCase\ListIngredientsRequest;
use Prophecy\Argument;

class ListIngredientsUCSpec extends ObjectBehavior
{


    private $request;
    private $ingredientsRepository;

    public function let(IngredientRepository $ingredientRepository)
    {
        $this->beConstructedWith($ingredientRepository);
        $this->ingredientsRepository = $ingredientRepository;
        $this->ingredientsRepository->getAll()->willReturn([]);
        $this->request = new ListIngredientsRequest();
    }

    public function it_returns_ListIngredientResponse()
    {
        $this->executeRequest()->shouldReturnAnInstanceOf('Play\UseCase\ListIngredientsResponse');
    }

    public function it_returns_two_ingredients(Ingredient $ingredient1, Ingredient $ingredient2)
    {
        $this->getAllIngredients()->willReturn([$ingredient1, $ingredient2]);
        $ingredient1->getName()->willReturn('rum');
        $ingredient2->getName()->willReturn('gin');

        $response = $this->executeRequest();

        $response->getIngredients()->shouldReturn([['name' => 'rum'], ['name' => 'gin']]);
        $response->getCount()->shouldReturn(2);
    }

    /**
     * @return mixed
     */
    private function executeRequest()
    {
        return $this->execute($this->request);
    }

    /**
     * @return mixed
     */
    private function getAllIngredients()
    {
        return $this->ingredientsRepository->getAll();
    }


}
