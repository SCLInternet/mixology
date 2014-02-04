<?php

namespace spec\Play\UseCase;

use PhpSpec\ObjectBehavior;
use Play\Entity\Ingredient;
use Play\UseCase\CreateIngredientRequest;
use Prophecy\Argument;
use Play\Repository\IngredientRepository;

class CreateIngredientUCSpec extends ObjectBehavior
{

    const TEST_NAME = "test name";
    const TEST_ID = 999;

    /** @var  IngredientRepository */
    private $ingredientRepository;

    /** @var  CreateIngredientRequest */
    private $request;

    public function let(IngredientRepository $ingredientRepository, Ingredient $ingredient)
    {
        $this->beConstructedWith($ingredientRepository);

        $this->request = new CreateIngredientRequest(self::TEST_NAME);

        $this->ingredientRepository = $ingredientRepository;
        $this->ingredientRepository->create()->willReturn($ingredient);
        $this->ingredientRepository->save($ingredient)->willReturn(null);

        $ingredient->setName(Argument::any())->willReturn(null);
        $ingredient->getId()->willReturn(self::TEST_ID);
    }

    public function it_sets_the_name(Ingredient $ingredient)
    {
        $this->executeUseCase();

        $ingredient->setName(self::TEST_NAME)->shouldHaveBeenCalled();
    }

    public function it_saves_the_ingredient($ingredient)
    {
        $this->executeUseCase();

        $this->ingredientRepository->save($ingredient)->shouldHaveBeenCalled();
    }

    public function it_returns_a_response_on_save($ingredient)
    {
        $this->executeUseCase()->shouldReturnAnInstanceOf('Play\UseCase\CreateIngredientResponse');
    }

    public function it_returns_an_ingredient_id($ingredient)
    {
        $response = $this->executeUseCase();
        $response->getId()->shouldReturn(self::TEST_ID);
    }

    private function executeUseCase()
    {
        return $this->execute($this->request);
    }
}
