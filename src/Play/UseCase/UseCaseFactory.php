<?php

namespace Play\UseCase;

use Play\Repository\RepositoryFactory;

class UseCaseFactory
{
    /** @var \Play\Repository\RepositoryFactory */
    private $repositoryFactory;

    public function __construct(RepositoryFactory $repositoryFactory)
    {
        $this->repositoryFactory = $repositoryFactory;
    }

    public function create($name)
    {
        $className = __NAMESPACE__ . '\\' . $name . 'UC';
        return new $className($this->repositoryFactory->create('Ingredient'));
    }
}
