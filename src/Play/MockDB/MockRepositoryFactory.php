<?php
/**
 * Created by PhpStorm.
 * User: fee
 * Date: 03/02/14
 * Time: 14:27
 */

namespace Play\MockDB;


use Play\Repository\RepositoryFactory;

class MockRepositoryFactory implements RepositoryFactory {
    private $repos = [];

    public function create($name)
    {
        if (!isset($this->repos[$name])) {
            $fqcn = __NAMESPACE__ . '\\Mock' . $name . 'Repository';

            $this->repos[$name] = new $fqcn();
        }

        return $this->repos[$name];
    }
}