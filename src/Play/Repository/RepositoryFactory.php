<?php
/**
 * Created by PhpStorm.
 * User: fee
 * Date: 03/02/14
 * Time: 14:21
 */

namespace Play\Repository;


interface RepositoryFactory {
    public function create($name);
} 