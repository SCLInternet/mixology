<?php

namespace Play\UseCase;

class CreateIngredientRequest implements RequestInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public static function fromArray(array $params)
    {
        return new self($params['name']);
    }
}
