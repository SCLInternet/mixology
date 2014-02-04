<?php

namespace spec\Play\UseCase;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreateIngredientRequestSpec extends ObjectBehavior
{
    const TEST_NAME = 'test-name';

    public function let()
    {
        $this->beConstructedWith(self::TEST_NAME);
    }

    public function it_is_a_request()
    {
        $this->shouldHaveType('Play\UseCase\RequestInterface');
    }

    public function it_sets_parameters()
    {
        $instance = $this::fromArray(['name' => 'other-test-name']);

        $instance->getName()->shouldReturn('other-test-name');
    }
}
