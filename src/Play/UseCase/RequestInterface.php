<?php
/**
 * Created by PhpStorm.
 * User: fee
 * Date: 03/02/14
 * Time: 14:47
 */

namespace Play\UseCase;


interface RequestInterface {
    static public function fromArray(array $params);
} 