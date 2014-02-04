<?php

namespace Play\UseCase;

class ListIngredientsRequest implements RequestInterface
{
    public static function fromArray(array $params)
    {
        return new self();
    }
}
