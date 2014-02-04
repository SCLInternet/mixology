<?php

namespace Play\Repository;

interface RepositoryFactory
{
    /**
     * @param int $name
     */
    public function create($name);
}
