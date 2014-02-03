<?php

namespace spec\Play\UseCase;

use PhpSpec\ObjectBehavior;
use Play\Repository\IngredientRepository;
use Play\Repository\RepositoryFactory;
use Prophecy\Argument;

class UseCaseFactorySpec extends ObjectBehavior
{
    public function let(
        RepositoryFactory $repoFactory,
        IngredientRepository $repo
    ) {
        $this->beConstructedWith($repoFactory);
        $repoFactory->create('Ingredient')->willReturn($repo);

    }

    public function it_creates_a_CreateIngredient_use_case()
    {
        $this->create('CreateIngredient')
             ->shouldReturnAnInstanceOf('Play\\UseCase\\CreateIngredientUC');
    }

    public function it_creates_a_ListIngredients_use_case()
    {
        $this->create('ListIngredients')
            ->shouldReturnAnInstanceOf('Play\\UseCase\\ListIngredientsUC');
    }
}
