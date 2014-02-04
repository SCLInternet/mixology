<?php

namespace spec\Play\MockDB;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Play\MockDB\Entity\MockIngredient;

class MockIngredientRepositorySpec extends ObjectBehavior
{
    public function it_initializes_with_3_entities()
    {
        $this->getAll()->shouldHaveCount(3);
    }

    public function it_saves_an_ingredient()
    {
        $this->save(new MockIngredient());

        $this->getAll()->shouldHaveCount(4);
    }
}
