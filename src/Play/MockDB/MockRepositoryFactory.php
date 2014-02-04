<?php

namespace Play\MockDB;

use Play\Repository\RepositoryFactory;

class MockRepositoryFactory implements RepositoryFactory
{
    /**
     * @var mixed[]
     */
    private $repos = [];

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function create($name)
    {
        if (!isset($this->repos[$name])) {
            $fqcn = __NAMESPACE__ . '\\Mock' . $name . 'Repository';

            $this->repos[$name] = new $fqcn();
        }

        return $this->repos[$name];
    }
}
